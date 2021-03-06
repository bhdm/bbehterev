<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller
{
    /**
     * @Route("publications/{url}", name="publications")
     * @Template("AppBundle:Publication:publication.html.twig")
     */
    public function indexAction(Request $request, $url)
    {
        $publication = $this->getDoctrine()->getRepository('AppBundle:Publication')->findOneById($url);
        return ['publication' => $publication];
    }

    /**
     * @Route("/news", name="news")
     * @Template("AppBundle:Publication:news.html.twig")
     */
    public function newsAction(Request $request)
    {
        $type = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBy(['slug' => 'news']);
        $news = $this->getDoctrine()->getRepository('AppBundle:Publication')->findBy(['enabled' => true, 'category' => $type],['id' => 'DESC']);
        return ['news' => $news];
    }


    /**
     * @Template("AppBundle:Publication:page.html.twig")
     */
    public function pageAction(Request $request, $url)
    {
        $page = $this->getDoctrine()->getRepository('AppBundle:Page')->findOneBySlug($url);
        if ($page === null){
            throw $this->createNotFoundException('Данной страницы не существует');
        }
        return ['page' => $page];
    }

    /**
     * @Route("event/{url}", name="event", options={"expose"=true})
     * @Template("AppBundle:Publication:event.html.twig")
     */
    public function eventAction(Request $request, $url)
    {
        $event = $this->getDoctrine()->getRepository('AppBundle:Publication')->findOneById($url);
        $t = preg_replace('/\[(\w+)(?!\w)[^\]]*\]((?:(?!\[\/\1).)*?)\[\/\1\]/i', ' \2 ', $event->getBody());
        $t = preg_replace('/\[(\w+)(?!\w)[^\]]*\]((?:(?!\[\/\1).)*?)\[\/\1\]/i', ' \2 ', $t);
        $t = preg_replace('/\[(\w+)(?!\w)[^\]]*\]((?:(?!\[\/\1).)*?)\[\/\1\]/i', ' \2 ', $t);
        $event->setBody($t);
        return ['publication' => $event];
    }

    /**
     * @Route("events/{type}", name="events")
     * @Template("AppBundle:Publication:eventList.html.twig")
     */
    public function eventListAction(Request $request, $type)
    {
        $type = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBy(['slug' => $type]);
        $events = $this->getDoctrine()->getRepository('AppBundle:Publication')->findBy(['category' => $type ],['id' => 'DESC']);
        return ['events' => $events, 'type' => $type ];
    }


    /**
     * @Route("category/{categoryUrl}", name="category")
     * @Template("AppBundle:Publication:category.html.twig")
     */
    public function categotyAction($categoryUrl){
        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBySlug($categoryUrl);

        return ['category' => $category];
    }


    /**
     * @param Request $request
     * @return array
     * @Route("/comment-add/{id}/{type}", name="comment_add", requirements={"type" = "publication|event|course"})
     * @Method("POST")
     */
    public function commentAddAction(Request $request, $id, $type){
        $em = $this->getDoctrine()->getManager();
        $comment = new Comment();
        $comment->setOwner($this->getUser());
        $comment->setBody($request->request->get('comment'));
        if ($type === 'publication'){
            $publication = $this->getDoctrine()->getRepository('AppBundle:Publication')->findOneBy(['id' => $id]);
            $comment->setPublication($publication);
        }elseif($type === 'course'){
            $course = $this->getDoctrine()->getRepository('AppBundle:Course')->findOneBy(['id' => $id]);
            $comment->setCourse($course);
        }else{
            throw $this->createNotFoundException('Вы пытаетесь прикрепить комментарий к странице, на который запрещены комментарии');
        }
        $em->persist($comment);
        $em->flush($comment);

        $session = $request->getSession();
        $session->getFlashBag()->add('notice', 'Ваш комментарий оставлен');
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    /**
     * @Route("/publication/{category}", name="publication_category")
     * @Template()
     */
    public function publicationCategoryAction($category){
        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBy(['slug' => $category]);
        $publications = $this->getDoctrine()->getRepository('AppBundle:Publication')->findBy(['category' => $category]);
        return ['publications' => $publications, 'category' => $category];
    }
}
