<?php
namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Test;
use AppBundle\Form\TestType;

/**
 * Class TestController
 * @package AdminBundle\Controller
 * @Route("/admin/test")
 */
class TestController extends Controller{
    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/", name="admin_test_list")
     * @Template()
     */
    public function listAction(){
        $items = $this->getDoctrine()->getRepository('AppBundle:IndexLog')->findBy([],['id' => 'DESC']);

//        $paginator  = $this->get('knp_paginator');
//        $pagination = $paginator->paginate(
//            $items,
//            $this->get('request')->query->get('testquestion', 1),
//            20
//        );

        return array('items' => $items);
    }

}