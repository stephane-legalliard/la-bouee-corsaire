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
			$formFactory = $this->get('form.factory');
			
			$service = new Service;
			$form = $formFactory->createNamed('new_service', 'AppBundle\Form\ServiceType', $service);
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				$service = $form->getData();
				$now = new \DateTime();
				$service
					->setDate($now)
					->setStatus('OP');
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
		
	}
	
?>
