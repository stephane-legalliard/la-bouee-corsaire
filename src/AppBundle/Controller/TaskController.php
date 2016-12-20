<?php
	
	namespace AppBundle\Controller;
	
	use AppBundle\Entity\Task;
	use AppBundle\Entity\User;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	
	class TaskController extends Controller {
		
		/**
		 *
		 * @Route("/task/show/{id}", name="task_show")
		 *
		 */
		public function showAction(Request $request, $id) {
			$task = $this
				->getDoctrine()
				->getRepository('AppBundle:Task')
				->find($id);
			
			if (!$task) {
				//TODO task not found page
				throw $this->createNotFoundException(
					'No Task found for id '.$id
				);
			}
			
			if ($task->isDisabled()) {
				//TODO task disabled page
				return new Response('<p>Task with id '.$task->getId().' has been disabled.</p>');
			}
			
			if ($task->getStatus() === 'DO') {
				//TODO task already done page
				return new Response('<p>Task with id '.$task->getId().' has already been done.</p>');
			}
			
			return $this->render('task/show.html.twig', array(
				'task' => $task,
				'user' => $this->getUser(),
			));
		}
		
		/**
		 *
		 * @Route("/user/task/new")
		 *
		 */
		public function newAction(Request $request) {
			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}
			
			$formFactory = $this->get('form.factory');
			
			$task = new Task;
			$form = $formFactory->createNamed('new_task', 'AppBundle\Form\TaskType', $task);
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				$user = $this->getUser();
				$task = $form->getData()
					->setDate(new \DateTime())
					->setStatus('OP')
					->setUser($user);
				$em = $this->getDoctrine()->getManager();
				$em->persist($task);
				$em->flush();
				
				return $this->redirectToRoute('task_show', array('id' => $task->getId()));
			}
			
			return $this->render('task/new.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
		/**
		 *
		 * @Route("/task/list")
		 *
		 */
		public function listAction() {
			$repository = $this->getDoctrine()->getRepository('AppBundle:Task');
			$tasks = $repository->findAll();
			return $this->render('task/list.html.twig', array(
				'tasks' => $tasks,
				'user' => $this->getUser(),
			));
		}
		
		/**
		 *
		 * @Route("/user/task/edit/{id}")
		 *
		 */
		public function editAction(Request $request, $id) {
			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}
			$user = $this->getUser();
			
			$task = $this
				->getDoctrine()
				->getRepository('AppBundle:Task')
				->find($id);
			
			if (!$task) {
				//TODO task not found page
				throw $this->createNotFoundException(
					'No Task found for id '.$id
				);
			}
			
			if ($task->getUser() !== $user) {
				//TODO task not owned by current user page
				return new Response('<p>You are not allowed to edit the Task with id '.$task->getId().'</p>');
			}
			
			if ($task->isDisabled()) {
				//TODO task disabled page
				return new Response('<p>Task with id '.$task->getId().' has been disabled.</p>');
			}
			
			if ($task->getStatus() === 'DO') {
				//TODO task already done page
				return new Response('<p>Task with id '.$task->getId().' has already been done.</p>');
			}
			
			$formFactory = $this->get('form.factory');
			$form = $formFactory->createNamed('edit_task', 'AppBundle\Form\TaskType', $task);
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				$task = $form->getData();
				$em = $this->getDoctrine()->getManager();
				$em->flush();
				return $this->redirectToRoute('task_show', array('id' => $id));
			}
			
			return $this->render('task/edit.html.twig', array(
				'form' => $form->createView(),
			));
		}
		
		/**
		 *
		 * @Route("/user/task/disable/{id}")
		 *
		 */
		public function disableAction(Request $request, $id) {
			if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
				throw $this->createAccessDeniedException();
			}
			$user = $this->getUser();
			
			$task = $this
				->getDoctrine()
				->getRepository('AppBundle:Task')
				->find($id);
			
			if (!$task) {
				throw $this->createNotFoundException(
					'No Task found for id '.$id
				);
			}
			
			if ($task->getUser() !== $user) {
				return new Response('<p>You are not allowed to edit the Task with id '.$task->getId().'</p>');
			}
			
			if ($task->isDisabled()) {
				//TODO task disabled page
				return new Response('<p>Task with id '.$task->getId().' has been disabled.</p>');
			}
			
			$task->setStatus('DI');
			
			$em = $this->getDoctrine()->getManager();
			$em->flush();
				
			//TODO task disabling confirmation page
			return new Response('<p>Task with id '.$task->getId().' has been disabled.</p>');
		}
		
	}
	
?>
