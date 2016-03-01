<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("AppBundle:Default:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $categoryVideo = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBy(['slug' => 'video']);
        $categoryNews = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBy(['slug' => 'new']);

        $publications = $this->getDoctrine()->getRepository('AppBundle:Publication')->findBy(['category' => $categoryNews],['created' => 'DESC'],4);

        $videos = $this->getDoctrine()->getRepository('AppBundle:Publication')->findBy(['category' => $categoryVideo],['created' =>  'DESC'],2);
        return [
            'publications' => $publications,
            'videos' => $videos,
        ];

    }

    /**
     * @Route("/generate-menu", name="generate_menu")
     * @Template("AppBundle::menu.html.twig")
     */
    public function generateMenuAction(){
        $menu = $this->getDoctrine()->getRepository('AppBundle:Menu')->findBy(['parent' => null, 'enabled' => true]);

        return ['menu' => $menu];
    }

    /**
     * @Route("/donate", name="donate")
     * @Template()
     */
    public function donateAction(){
        return [];
    }

    /**
     * роут для данного метода указывается в routing.yml что бы был без /page
     * @Route("/page/{url}", name="page")
     * @Template()
     */
    public function pageAction($url){
        $page = $this->getDoctrine()->getRepository('AppBundle:Page')->findOneBy(['slug' => $url]);
        if ($page === null){
            throw $this->createNotFoundException('Данная страница не найдена');
        }
        return ['page' => $page];
    }

    /**
     * @Route("/testirovanie", name="testirovanie")
     * @Template()
     */
    public function testAction(){
        return [];
    }

    /**
     * @Route("/index-basdai", name="index-basdai")
     * @Template()
     */
    public function index1Action(){
        return [];
    }

    /**
     * @Route("/index-basfi", name="index-basfi")
     * @Template()
     */
    public function index2Action(){
        return [];
    }


    /**
     * @Route("/otdeleniya", name="otdeleniya")
     * @Template()
     */
    public function otdeleniyaAction(){
        return [];
    }

}
