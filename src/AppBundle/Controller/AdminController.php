<?php

	namespace AppBundle\Controller;

	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;

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
		 *@Route("/users")
		 */
		public function listAction() {
			$users = $this->get('fos_user.user_manager')
			              ->findUsers();
			return $this->render('user/list.html.twig', array(
				'users' => $users,
			));
		}
	}

?>
