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
	 * @Route("/user/need")
	 */

	class NeedController extends Controller {
		
		/**
		*@Route("/new")
		*/

		public function newAction(Request $request) {
			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}
			
			$formFactory = $this->get('form.factory');
			
			$need = new Need;
			$form = $formFactory->createNamed('new_need', 'AppBundle\Form\NeedType', $need);
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				$user = $this->getUser();
				$need = $form->getData();
				if ($user->getHours() < $need->getHours()) {
					//TODO not enough hours credit page
					return new Response('<p>New Need not created. You need at least '.$need->getHours().' hours in your credit to post it, and you have only '.$user->getHours().' hours available.</p>');
				}
				$need
					->setDate(new \DateTime())
					->setStatus('OP')
					->setUser($user);
				$em = $this->getDoctrine()->getManager();
				$em->persist($need);
				$em->flush();
				
				//TODO creation confirmation page
				return new Response('<p>Saved new Need with id '.$need->getId()."</p>\n<pre>".var_export($need, true).'</pre>');
			}
			
			return $this->render('user/need_new.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
        /**
         *
         * @Route("/list")
         *
         */

        /*public function listNeedAction(Request $request)
            {

                $needManager = $this->getDoctrine()->getManager();
                $need = $needManager->listNeedAction();


               return $this->render('need/need_list.html.twig', array(
                    'need' => $need,
                ));
                }*/


	}
	
?>
