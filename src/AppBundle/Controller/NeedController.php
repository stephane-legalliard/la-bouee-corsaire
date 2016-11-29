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


class NeedController extends Controller
{

/**
 *
 * @Route("/need")
 *
 */


public function listNeedAction(Request $request)
    {

    	// create a need 
        $need = new need();

        $form = $this->createFormBuilder($task)
        	->add('need', TextType::class)
        	->getForm();


       return $this->render('admin/need.html.twig', array(
            'form' => $form->createView(),
        ));
        }

}