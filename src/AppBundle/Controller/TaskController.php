<?php

	namespace AppBundle\Controller;

	use AppBundle\Entity\Task;
	use AppBundle\Entity\User;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\RedirectResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	/**
	 * Task-related operations
	 *
	 * @Route("/task")
	 */
	class TaskController extends Controller {

		/**
		 * Return the current User
		 *
		 * @return User
		 */
		protected function getAuthenticatedUser() {
			if (
				!$this
					->get('security.authorization_checker')
					->isGranted('IS_AUTHENTICATED_FULLY')
			) {
				throw $this->createAccessDeniedException();
			}
			return $this->getUser();
		}

		/**
		 * Return the Task instance identified by the given ID
		 *
		 * @param int $id
		 *
		 * @return Task
		 */
		protected function getTaskById($id) {
			$task = $this
				->getDoctrine()
				->getRepository('AppBundle:Task')
				->find($id);

			if (!$task) {
				throw $this->createNotFoundException(
					'No Task found for id '.$id
				);
			}

			return $task;
		}

		/**
		 * Check that the given Task is owned by the current User
		 *
		 * @param Task $task
		 */
		protected function checkOwnership(Task $task) {
			if ($task->getUser() !== $this->getUser()) {
				throw $this->createAccessDeniedException(
					'You are not allowed to edit the Task with id '.$task->getId()
				);
			}
		}

		/**
		 * Check that the given Task is not disabled
		 *
		 * @param Task $task
		 */
		protected function checkEnabled(Task $task) {
			if ($task->isDisabled()) {
				throw $this->createAccessDeniedException(
					'Task with id '.$task->getId().' has been disabled.'
				);
			}
		}

		/**
		 * Save Task
		 *
		 * @param Task $task
		 *
		 * @return RedirectResponse
		 */
		protected function saveTask($task) {
			// Set Task creation date to now if not already set
			if ($task->getDate() === null) {
				$task->setDate(new \DateTime());
			}

			// Set Task owner to current User if not already set
			if ($task->getUser() === null) {
				$task->setUser($this->getUser());
			}

			$em = $this->getDoctrine()->getManager();
			$em->persist($task);
			$em->flush();

			return $this->redirectToRoute('task_show', [
				'id' => $task->getId()
			]);
		}

		/**
		 * Show details of the Task identified by the given ID
		 *
		 * @Route("/show/{id}", name="task_show")
		 *
		 * @param Request $request
		 * @param int     $id
		 *
		 * @return Response
		 */
		public function showAction(Request $request, $id) {
			$task = $this->getTaskById($id);
			$this->checkEnabled($task);

			return $this->render('task/show.html.twig', [
				'task' => $task,
				'user' => $this->getUser(),
			]);

		}

		/**
		 * Show a form allowing creation of a new Task owned by the current User
		 *
		 * @Route("/new")
		 *
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function newAction(Request $request) {
			$user = $this->getAuthenticatedUser();

			$formFactory = $this->get('form.factory');

			$task = new Task;
			$form = $formFactory->createNamed(
				'new_task',
				'AppBundle\Form\TaskType',
				$task
			);

			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				return saveTask($form->getData());
			}

			return $this->render('task/new.html.twig', [
				'form' => $form->createView(),
				'task' => $task,
			]);
		}

		/**
		 * Show full list of Tasks
		 *
		 * @Route("/list")
		 *
		 * @return Response
		 */
		public function listAction() {
			$tasks = $this
				->getDoctrine()
				->getRepository('AppBundle:Task')
				->findBy(
					['enabled' => true],
					['date' => 'DESC']
				);
			
			return $this->render('task/list.html.twig', [
				'tasks' => $tasks,
				'user' => $this->getUser(),
			]);
		}

		/**
		 * Show a form allowing edition of the Task identified by the given ID
		 *
		 * @Route("/edit/{id}")
		 *
		 * @param Request $request
		 * @param int     $id
		 *
		 * @return Response
		 */
		public function editAction(Request $request, $id) {
			$user = $this->getAuthenticatedUser();
			$task = $this->getTaskById($id);
			$this->checkOwnership($task);
			$this->checkEnabled($task);

			$formFactory = $this->get('form.factory');
			$form = $formFactory->createNamed(
				'edit_task',
				'AppBundle\Form\TaskType',
				$task
			);

			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				return saveTask($form->getData());
			}

			return $this->render('task/edit.html.twig', [
				'form' => $form->createView(),
				'task' => $task,
			]);
		}

		/**
		 * Disable the Task identified by the given ID
		 *
		 * @Route("/disable/{id}")
		 *
		 * @param Request $request
		 * @param int     $id
		 *
		 * @return Response
		 */
		public function disableAction(Request $request, $id) {
			$user = $this->getAuthenticatedUser();
			$task = $this->getTaskById($id);
			$this->checkOwnership($task);
			$this->checkEnabled($task);

			$task->disable();
			$this->getDoctrine()->getManager()->flush();

			//TODO task disabling confirmation page
			return new Response(
				'<p>Task with id '.$task->getId().' has been disabled.</p>'
			);
		}

	}

?>
