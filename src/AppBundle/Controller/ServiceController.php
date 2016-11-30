<?php
	
	namespace AppBundle\Controller;
	
	use AppBundle\Entity\Service;
	use AppBundle\Entity\User;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	
	/**
	 * Service controller
	 *
	 * @Route("/user/service")
	 */
	class ServiceController extends Controller {
		
		/**
		*@Route("/new")
		*/
		public function newAction(Request $request) {
			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}
			
			$formFactory = $this->get('form.factory');
			
			$service = new Service;
			$form = $formFactory->createNamed('new_service', 'AppBundle\Form\ServiceType', $service);
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				$user = $this->getUser();
				$service = $form->getData();
				$now = new \DateTime();
				$service
					->setDate($now)
					->setStatus('OP')
					->setUser($user);
				$em = $this->getDoctrine()->getManager();
				$em->persist($service);
				$em->flush();
				
				//TODO creation confirmation page
				return new Response('<p>Saved new Service with id '.$service->getId()."</p>\n<pre>".var_export($service, true).'</pre>');
			}
			
			return $this->render('user/service_new.html.twig', array(
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
			
			$service = $this
				->getDoctrine()
				->getRepository('AppBundle:Service')
				->find($id);
			
			if (!$service) {
				throw $this->createNotFoundException(
					'No Service found for id '.$id
				);
			}
			
			if ($service->getUser() !== $user) {
				return new Response('<p>You are not allowed to edit the Service with id '.$service->getId().'</p>');
			}
			
			$formFactory = $this->get('form.factory');
			$form = $formFactory->createNamed('edit_service', 'AppBundle\Form\ServiceType', $service);
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				$service = $form->getData();
				$em = $this->getDoctrine()->getManager();
				$em->flush();
				
				//TODO edit confirmation page
				return new Response('<p>Saved modifications to Service with id '.$service->getId()."</p>\n<pre>".var_export($service, true).'</pre>');
			}
			
			return $this->render('user/service_edit.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
	}
	
?>
