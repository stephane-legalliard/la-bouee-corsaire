<?php
	
	namespace AppBundle\Controller;
	
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
				return new Response('<p>Saved new Need with id '.$need->getId()."</p>\n<pre>".var_export($need, true).'</pre>');
			}
			
			return $this->render('user/need_new.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
	}
	
?>
