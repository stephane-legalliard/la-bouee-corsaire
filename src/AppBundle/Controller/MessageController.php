<?php

	namespace AppBundle\Controller;

	use AppBundle\DBAL\Types\TransactionStatusType;
	use AppBundle\Entity\Message;
	use AppBundle\Entity\Transaction;
	use AppBundle\Entity\User;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Doctrine\Common\Collections\Criteria;

	/**
	 * Message controller.
	 *
	 * @Route("/message")
	 */
	class MessageController extends Controller {

		/**
		 *
		 * @Route("/new/{id}")
		 *
		 */
		public function newAction(Request $request, $id) {

			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}

			$em = $this->getDoctrine()->getManager();

			$author = $this->getUser();

			$task = $this
				->getDoctrine()
				->getRepository('AppBundle:Task')
				->find($id);

			// find all Transactions associated with current Task
			$transactions = $this
				->getDoctrine()
				->getRepository('AppBundle:Transaction')
				->findBy(array(
					'task' => $task,
				));

			// find Transaction associated with current User (from previous list)
			$found = false;
				if (count($transactions) > 0) {
				foreach ($transactions as $transaction) {
					if ($transaction->getUsers()->contains($author)) {
						$found = true;
						break;
					}
				}
			}

			// if no Transaction is associated with both the current Task and User,
			// create a new one
			if (! $found) {
				$transaction = new Transaction();
				$transaction
					->setTask($task)
					->setStatus(TransactionStatusType::OPEN)
					->setDuration(0)
					->addUser($author)
					->addUser($task->getUser());
				$em->persist($transaction);
			}

			$formFactory = $this->get('form.factory');

			$message = new Message;
			$form = $formFactory->createNamed('new_message', 'AppBundle\Form\MessageType', $message);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {

				$dest = $task->getUser();

				$message = $form->getData();

				// If the duration is not a valid value, set it to 0
				$duration = (float) $message->getDuration();
				if (!$duration >= 0) {
					$duration = 0;
					$message->setDuration($duration);
				}

				$now = new \DateTime();
				$message
					->setDate($now)
					->setAuthor($author)
					->setDest($dest)
					->setTransaction($transaction);
				$em->persist($message);

				// If the duration is not 0, store it in the Transaction
				if ($duration != 0) {
					$transaction->setDuration($duration);
				}

				$em->flush();

				// send an e-mail to the Message recipient
				$email = \Swift_Message::newInstance()
					->setSubject('La Bouée Corsaire - nouveau message')
					->setFrom($this->getParameter('postmaster.email'))
					->setTo($dest->getEmail())
					->setBody(
						$this->renderView(
							'message/email.txt.twig',
							array(
								'dest'    => $dest,
								'author'  => $author,
								'message' => $message,
							)
						),
						'text/plain'
					);
				$this->get('mailer')->send($email);

				return $this->redirectToRoute('message_show', array('id' => $message->getId()));
			}

			return $this->render('message/new.html.twig', array(
				'form' => $form->createView(),
			));
		}

		/**
		 *
		 * @Route("/show/{id}", name="message_show")
		 *
		 */
		public function showAction(Request $request, $id) {

			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}
			$user = $this->getUser();

			$message = $this
				->getDoctrine()
				->getRepository('AppBundle:Message')
				->find($id);

			if (!$message) {
				//TODO message not found page
				throw $this->createNotFoundException(
					'No Message found for id '.$id
				);
			}

			if ($message->getAuthor() !== $user && $message->getDest() !== $user) {
				//TODO message not owned by current user page
				return new Response('<p>You are not allowed to see the Message with id '.$id.'</p>');
			}

			return $this->render('message/show.html.twig', array(
				'message' => $message,
				'user' => $user,
			));

		}

		/**
		 *
		 * @Route("/list", name="message_list")
		 *
		 */
		public function listAction() {

			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}
			$user = $this->getUser();

			$messages = $this
				->getDoctrine()
				->getRepository('AppBundle:Message')
				->findBy(array(), array('date' => 'DESC'));

			$messages_sent = [];
			$messages_received = [];
			foreach ($messages as $message) {
				if ($message->getAuthor() == $user) {
					$messages_sent[] = $message;
				}
				if ($message->getDest() == $user) {
					$messages_received[] = $message;
				}
			}

			return $this->render('message/list.html.twig', array(
				'messages_sent' => $messages_sent,
				'messages_received' => $messages_received,
			));

		}

	}

?>
