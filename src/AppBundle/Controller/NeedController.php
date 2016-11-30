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
		*@Route("/edit/{id}")
		*/
		public function editAction(Request $request, $id) {
			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}
			$user = $this->getUser();
			
			$need = $this
				->getDoctrine()
				->getRepository('AppBundle:Need')
				->find($id);
			
			if (!$need) {
				throw $this->createNotFoundException(
					'No Need found for id '.$id
				);
			}
			
			if ($need->getUser() !== $user) {
				return new Response('<p>You are not allowed to edit the Need with id '.$need->getId().'</p>');
			}
			
			$formFactory = $this->get('form.factory');
			$form = $formFactory->createNamed('edit_need', 'AppBundle\Form\NeedType', $need);
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				$need = $form->getData();
				$em = $this->getDoctrine()->getManager();
				$em->flush();
				
				//TODO edit confirmation page
				return new Response('<p>Saved modifications to Need with id '.$need->getId()."</p>\n<pre>".var_export($need, true).'</pre>');
			}
			
			return $this->render('user/need_edit.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
	}
	
?>
