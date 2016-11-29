<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Task;
use Doctrine\ORM\Mapping as ORM;


/**
 * User controller.
 *
 * @Route("/admin")
 */


class ServiceController extends Controller
{

/**
 *
 * @Route("/service")
 *
 */


public function listServiceAction(Request $request)
    {

    	// create a service 
        $service = new service();

        $form = $this->createFormBuilder($task)
        	->add('service', TextType::class)
        	->getForm();


       return $this->render('admin/service.html.twig', array(
            'form' => $form->createView(),
        ));
        }

}