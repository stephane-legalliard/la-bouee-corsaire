<?php

	namespace AppBundle\Controller;

	use FOS\UserBundle\Event\FilterUserResponseEvent;
	use FOS\UserBundle\Event\FormEvent;
	use FOS\UserBundle\Event\GetResponseUserEvent;
	use FOS\UserBundle\FOSUserEvents;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\RedirectResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	/**
	 * Admin Users controller.
	 *
	 * @Route("/admin/user")
	 */
	class AdminUserController extends Controller {

		protected function getUserById($id) {
			$user = $this
				->getDoctrine()
				->getRepository('AppBundle:User')
				->find($id);

			if (!$user) {
				//TODO user not found page
				throw $this->createNotFoundException(
					'No User found for id '.$id
				);
			}

			return $user;
		}

		/**
		 *
		 * @Route("/show/{id}", name="admin_user_show")
		 *
		 */
		public function showAction(Request $request, $id) {
			$user = $this->getUserById($id);

			return $this->render('admin/user/show.html.twig', [
				'user' => $user,
			]);
		}

		/**
		 *
		 * @Route("/list", name="admin_user_list")
		 *
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
		 * Edit the user.
		 *
		 * @Route("/edit/{id}", name="admin_user_edit")
		 *
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function editAction(Request $request, $id) {
			$user = $this->getUserById($id);

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
