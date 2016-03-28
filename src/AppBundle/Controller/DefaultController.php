<?php

namespace AppBundle\Controller;

use AppBundle\Entity\IndexLog;
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
    public function index1Action(Request $request){
        $msg = null;
        if ($request->getMethod() === 'POST'){
            $log = new IndexLog();
            $log->setType('basdai');
            $log->setGender($request->request->get('gender'));
            $log->setAge($request->request->get('age'));
            $log->setBall($request->request->get('balls')/5);
            $this->getDoctrine()->getManager()->persist($log);
            $this->getDoctrine()->getManager()->flush($log);
            $balls = $request->request->get('balls');
            $balls = $balls/5;
            if ($balls < 4){
                $msg = 'Активность заболевания – низкая';
            }
            if ($balls >= 4){
                $msg = 'Активность заболевания – высокая. Если результат индекса увеличился на 20% по сравнению с предыдущей его оценкой, необходимо обратиться к лечащему врачу для изменения терапии.';
            }
        }

        return ['msg' => $msg];
    }

    /**
     * @Route("/index-basfi", name="index-basfi")
     * @Template()
     */
    public function index2Action(Request $request){
        $msg = null;
        if ($request->getMethod() === 'POST'){
            $log = new IndexLog();
            $log->setType('basfi');
            $log->setGender($request->request->get('gender'));
            $log->setAge($request->request->get('age'));
            $log->setBall($request->request->get('balls')/10);
            $this->getDoctrine()->getManager()->persist($log);
            $this->getDoctrine()->getManager()->flush($log);
            $balls = $request->request->get('balls');
            $balls = $balls/10;
            if ($balls == 0){
                $msg = 'у Вас нет функциональных нарушений';
            }elseif ($balls <= 5){
                $msg = 'у Вас умеренные функциональные ограничения';
            }else{
                $msg = 'Функциональные нарушения – выраженные. Чем ближе результаты оценки индекса к «10», тем хуже
                функция позвоночника и суставов. ';
            }
        }

        return ['msg' => $msg];
    }


    /**
     * @Route("/otdeleniya", name="otdeleniya")
     * @Template()
     */
    public function otdeleniyaAction(){
        return [];
    }

    /**
     * @Route("/feedback", name="feedback")
     * @Template()
     */
    public function feedbackAction(){
        return [];
    }

    /**
     * Редирект для старых картинок
     * @Route("/images/{url}")
     */
    public function oldImagesAction($url){
        return $this->redirect('/images/'.$url);
    }

    /**
     * @ROute("/search", name="search")
     */
    public function searchAction(Request $request){
        $news = $this->getDoctrine()->getRepository('AppBundle:Publication')->search($request->query->get('search'));
        return ['news' => $news, 'search' => $request->query->get('search')];
    }

}
