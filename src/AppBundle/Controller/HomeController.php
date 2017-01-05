<?php

	namespace AppBundle\Controller;

	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
	use Symfony\Component\HttpFoundation\Request;

	/**
	 * Home page
	 */
	class HomeController extends BaseController {

		/**
		 * Show home page
		 *
		 * @Route("/", name="homepage")
		 *
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function indexAction(Request $request) {

			$repository = $this->getDoctrine()->getRepository('AppBundle:Task');
			$tasks = $repository->findBy(
				array('enabled' => true),
				array('date' => 'DESC')
			);

			$tasks1 = [];
			$tasks2 = [];
			for ($index = 0; $index < 6; $index++) {
				if (isset($tasks[$index])) {
					if ($index < 3) {
						$tasks1[] = $tasks[$index];
					}
					else {
						$tasks2[] = $tasks[$index];
					}
				}
				else break;
			}

			return $this->render('index.html.twig', array(
				'tasks1' => $tasks1,
				'tasks2' => $tasks2,
			));

		}
	}

?>
