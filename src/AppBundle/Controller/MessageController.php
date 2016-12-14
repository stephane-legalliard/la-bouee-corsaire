<?php

	namespace AppBundle\Controller;

	use AppBundle\Entity\Message;
	use AppBundle\Entity\User;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	class MessageController extends Controller {

		/**
		 *
		 * @Route("/user/message/new")
		 *
		 */
		public function newAction(Request $request) {

			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}

			$formFactory = $this->get('form.factory');

			$message = new Message;
			$form = $formFactory->createNamed('new_message', 'AppBundle\Form\MessageType', $message);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$user = $this->getUser();
				$message = $form->getData();
				$now = new \DateTime();
				$message
					->setDate($now)
					->setAuthor($user);
				$em = $this->getDoctrine()->getManager();
				$em->persist($message);
				$em->flush();

				//TODO sending confirmation page
				return new Response('<p>Message with id '.$message->getId()." sent.</p>\n<pre>".var_export($message, true).'</pre>');
			}

			return $this->render('message/new.html.twig', array(
				'form' => $form->createView(),
			));
		}

	}

?>
