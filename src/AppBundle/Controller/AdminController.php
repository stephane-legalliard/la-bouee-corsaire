<?php

	namespace AppBundle\Controller;

	use AppBundle\Entity\User;
	use FOS\UserBundle\Event\FilterUserResponseEvent;
	use FOS\UserBundle\Event\FormEvent;
	use FOS\UserBundle\Event\GetResponseUserEvent;
	use FOS\UserBundle\Form\Factory\FactoryInterface;
	use FOS\UserBundle\FOSUserEvents;
	use FOS\UserBundle\Model\UserInterface;
	use FOS\UserBundle\Model\UserManagerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\EventDispatcher\EventDispatcherInterface;
	use Symfony\Component\HttpFoundation\RedirectResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Security\Core\Exception\AccessDeniedException;

	/**
	 * Admin controller.
	 *
	 * @Route("/admin")
	 */
	class AdminController extends Controller {
		/**
		 *
		 * @Route("/user/show/{id}", name="user_show")
		 *
		 */
		public function showAction(Request $request, $id) {
			$user = $this->getDoctrine()
			             ->getRepository('AppBundle:User')
			             ->find($id);
			
			if (!$user) {
				//TODO user not found page
				throw $this->createNotFoundException(
					'No User found for id '.$id
				);
			}
			
			return $this->render('user/show.admin.html.twig', array(
				'user' => $user,
			));
		}
		
		/**
		 *
		 * @Route("/users")
		 *
		 */
		public function listAction() {
			$users = $this->get('fos_user.user_manager')
			              ->findUsers();
			return $this->render('user/list.html.twig', array(
				'users' => $users,
			));
		}

		/**
		 * Edit the user.
		 *
		 * @Route("/user/edit/{id}", name="user_edit")
		 *
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function editAction(Request $request, $id) {
			$user = $this->getDoctrine()
			             ->getRepository('AppBundle:User')
			             ->find($id);

			if (!is_object($user) || !$user instanceof UserInterface) {
				//TODO user not found page
				throw $this->createNotFoundException(
					'No User found for id '.$id
				);
			}

			/** @var $dispatcher EventDispatcherInterface */
			$dispatcher = $this->get('event_dispatcher');

			$event = new GetResponseUserEvent($user, $request);
			$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

			if (null !== $event->getResponse()) {
				return $event->getResponse();
			}

			/** @var $formFactory FactoryInterface */
			$formFactory = $this->get('fos_user.profile.form.factory');

			$formFactory = $this->get('form.factory');
			$form = $formFactory->createNamed('edit_user', 'AppBundle\Form\ProfileAdminType', $user);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				/** @var $userManager UserManagerInterface */
				$userManager = $this->get('fos_user.user_manager');

				$event = new FormEvent($form, $request);
				$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

				$userManager->updateUser($user);

				if (null === $response = $event->getResponse()) {
					$url = $this->generateUrl('user_show', array('id' => $id));
					$response = new RedirectResponse($url);
				}

				$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

				return $response;
			}

			return $this->render('user/edit.admin.html.twig', array(
				'form' => $form->createView(),
			));
		}

	}

?>
