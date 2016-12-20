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
				$now = new \DateTime();
				$message
					->setDate($now)
					->setAuthor($author)
					->setDest($dest)
					->setTransaction($transaction);
				$em->persist($message);
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

				//TODO sending confirmation page
				return new Response('<p>Message with id '.$message->getId().' sent.</p>');
			}

			return $this->render('message/new.html.twig', array(
				'form' => $form->createView(),
			));
		}

	}

?>
