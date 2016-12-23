<?php

	namespace AppBundle\Controller;

	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	/**
	 * Admin controller.
	 *
	 * @Route("/admin")
	 */
	class AdminController extends Controller {

		/**
		 *
		 * @Route("/")
		 *
		 */
		public function indexAction() {
			return $this->render('admin/index.html.twig');
		}

	}

?>
