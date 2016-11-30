<?php

namespace AppBundle\Controller;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use AppBundle\Entity\Task;
    use Doctrine\ORM\Mapping as ORM;
    use AppBundle\Entity\Need;
    use AppBundle\Entity\User;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;


	/**
	 * Need controller
	 *
	 * @Route("/need")
	 */

	class NeedController extends Controller {
		
		/**
		*@Route("/new")
		*/

		public function newAction(Request $request) {
			$formFactory = $this->get('form.factory');
			
			$need = new Need;
			$form = $formFactory->createNamed('new_need', 'AppBundle\Form\NeedType', $need);
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				$need = $form->getData();
				$now = new \DateTime();
				$need
					->setDate($now)
					->setStatus('OP');
				$em = $this->getDoctrine()->getManager();
				$em->persist($need);
				$em->flush();
				
				//TODO creation confirmation page
				return new Response('Saved new need with id '.$need->getId());
			}
			
			return $this->render('user/task_new.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
        /**
         *
         * @Route("/list")
         *
         */

        public function listNeedAction(Request $request)
            {

                $needManager = $this->getDoctrine()->getManager();
                $need = $needManager->listNeedAction();


               return $this->render('need/need_list.html.twig', array(
                    'need' => $need,
                ));
                }


	}
	
?>
