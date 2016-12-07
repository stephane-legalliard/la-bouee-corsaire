<?php
	
	namespace AppBundle\Controller;
	
	use AppBundle\Entity\Need;
	use AppBundle\Entity\User;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	
	class NeedController extends Controller {
		
		/**
		 *
		 * @Route("/need/show/{id}", name="need_show")
		 *
		 */
		public function showAction(Request $request, $id) {
			$need = $this
				->getDoctrine()
				->getRepository('AppBundle:Need')
				->find($id);
			
			if (!$need) {
				//TODO need not found page
				throw $this->createNotFoundException(
					'No Need found for id '.$id
				);
			}
			
			if ($need->isDisabled()) {
				//TODO need disabled page
				return new Response('<p>Need with id '.$need->getId().' has been disabled.</p>');
			}
			
			if ($need->getStatus() === 'DO') {
				//TODO need already done page
				return new Response('<p>Need with id '.$need->getId().' has already been done.</p>');
			}
			
			return $this->render('need/show.html.twig', array(
				'need' => $need,
			));
		}
		
		/**
		 *
		 * @Route("/user/need/new")
		 *
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
				
				return $this->redirectToRoute('need_show', array('id' => $need->getId()));
			}
			
			return $this->render('need/new.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
		/**
		 *
		 * @Route("/need/list")
		 *
		 */
		public function listAction() {
			$repository = $this->getDoctrine()->getRepository('AppBundle:Need');
			$needs = $repository->findAll();
			return $this->render('need/list.html.twig', array(
				'needs' => $needs,
			));
		}
		
		/**
		 *
		 * @Route("/user/need/edit/{id}")
		 *
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
				//TODO need not found page
				throw $this->createNotFoundException(
					'No Need found for id '.$id
				);
			}
			
			if ($need->getUser() !== $user) {
				//TODO need not owned by current user page
				return new Response('<p>You are not allowed to edit the Need with id '.$need->getId().'</p>');
			}
			
			if ($need->isDisabled()) {
				//TODO need disabled page
				return new Response('<p>Need with id '.$need->getId().' has been disabled.</p>');
			}
			
			if ($need->getStatus() === 'DO') {
				//TODO need already done page
				return new Response('<p>Need with id '.$need->getId().' has already been done.</p>');
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
			
			return $this->render('need/edit.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
		/**
		 *
		 * @Route("/user/need/disable/{id}")
		 *
		 */
		public function disableAction(Request $request, $id) {
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
			
			if ($need->isDisabled()) {
				//TODO need disabled page
				return new Response('<p>Need with id '.$need->getId().' has been disabled.</p>');
			}
			
			$need->setStatus('DI');
			
			$em = $this->getDoctrine()->getManager();
			$em->flush();
				
			//TODO need disabling confirmation page
			return new Response('<p>Need with id '.$need->getId().' has been disabled.</p>');
		}
		
	}
	
?>
