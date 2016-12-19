<?php

	namespace AppBundle\Controller;

	use AppBundle\Entity\Message;
	use AppBundle\Entity\Transaction;
	use AppBundle\Entity\User;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Doctrine\Common\Collections\Criteria;

	class MessageController extends Controller {

		/**
		 *
		 * @Route("/user/message/new/{id}")
		 *
		 */
		public function newAction(Request $request, $id) {

			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}

			$em = $this->getDoctrine()->getManager();

			$author = $this->getUser();

			$need = $this
				->getDoctrine()
				->getRepository('AppBundle:Need')
				->find($id);

			// find all Transactions associated with current Need
			$transactions = $this
				->getDoctrine()
				->getRepository('AppBundle:Transaction')
				->findBy(array(
					'need' => $need,
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

			// if no Transaction is associated with both the current Need and User,
			// create a new one
			if (! $found) {
				$transaction = new Transaction();
				$transaction
					->setNeed($need)
					->addUser($author)
					->addUser($need->getUser());
				$em->persist($transaction);
			}

			$formFactory = $this->get('form.factory');

			$message = new Message;
			$form = $formFactory->createNamed('new_message', 'AppBundle\Form\MessageType', $message);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {

				$dest = $need->getUser();

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
					->setFrom('contact@fondationface.org')
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
