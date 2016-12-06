<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * User controller.
 *
 * @Route("/admin")
 */


class AdminController extends Controller
{

/**
*@Route("/users")
*/

    public function findUsers()
    {
    	$userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('user/list.html.twig', array(
        	'users' => $users,
        ));
    }

    	
  	
}