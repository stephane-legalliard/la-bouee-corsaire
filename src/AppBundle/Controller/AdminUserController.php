<?php

	namespace AppBundle\Controller;

	use FOS\UserBundle\Event\FilterUserResponseEvent;
	use FOS\UserBundle\Event\FormEvent;
	use FOS\UserBundle\Event\GetResponseUserEvent;
	use FOS\UserBundle\FOSUserEvents;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Component\HttpFoundation\RedirectResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	/**
	 * Administration tasks related to Users
	 *
	 * @Route("/admin/user")
	 */
	class AdminUserController extends Controller {
		/**
		 * Show details of the User identified by the given ID
		 *
		 * @Route("/show/{id}", name="admin_user_show")
		 *
		 * @param Request $request
		 * @param int     $id
		 *
		 * @return Response
		 */
		public function showAction(Request $request, $id) {
			$user = $this->getById('User', $id);

			return $this->render('admin/user/show.html.twig', [
				'user' => $user,
			]);
		}

		/**
		 * Show full list of registered Users
		 *
		 * @Route("/list", name="admin_user_list")
		 *
		 * @return Response
		 */
		public function listAction() {
			$users = $this
				->get('fos_user.user_manager')
				->findUsers();

			return $this->render('admin/user/list.html.twig', [
				'users' => $users,
			]);
		}

		/**
		 * Show a form allowing edition of the User identified by the given ID
		 *
		 * @Route("/edit/{id}", name="admin_user_edit")
		 *
		 * @param Request $request
		 * @param int     $id
		 *
		 * @return Response
		 */
		public function editAction(Request $request, $id) {
			$user = $this->getById('User', $id);

			$dispatcher = $this->get('event_dispatcher');

			$event = new GetResponseUserEvent($user, $request);
			$dispatcher->dispatch(
				FOSUserEvents::PROFILE_EDIT_INITIALIZE,
				$event
			);
			$response = $event->getResponse();

			if ($response !== null) {
				return $response;
			}

			$form = $this
				->get('form.factory')
				->createNamed('edit_user', 'AppBundle\Form\ProfileAdminType', $user);

			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$event = new FormEvent($form, $request);
				$dispatcher->dispatch(
					FOSUserEvents::PROFILE_EDIT_SUCCESS,
					$event
				);
				$this->get('fos_user.user_manager')->updateUser($user);
				$response = $event->getResponse();

				if ($response === null) {
					$url = $this->generateUrl('admin_user_show', [
						'id' => $id
					]);
					$response = new RedirectResponse($url);
				}

				$dispatcher->dispatch(
					FOSUserEvents::PROFILE_EDIT_COMPLETED,
					new FilterUserResponseEvent($user, $request, $response)
				);

				return $response;
			}

			return $this->render('admin/user/edit.html.twig', [
				'form' => $form->createView(),
				'user' => $user,
			]);
		}

	}

?>
