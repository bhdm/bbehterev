<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TestLog;
use donatj\SimpleCalendar;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class WidgetController extends Controller
{
    /**
     * @Route("/widget-calendar/{year}/{month}", name="widget_calendar", defaults={"year"=null, "month"=null }, options={"exponse" = true})
     * @Template("")
     */
    public function calendarAction($year=null, $month=null){
        if ($year === null){
            $year = (new \DateTime())->format('Y');
        }
        if ($month === null){
            $month = (new \DateTime())->format('m');
        }

        $dateStart = new \DateTime($year.'-'.$month.'-01 00:00:00');
        $dateEnd = new \DateTime($year.'-'.($month+1).'-01 00:00:00');

        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEvent($dateStart,$dateEnd);

        return ['events' => $events];
    }

    /**
     * @Route("/widget-test/{test}/{step}", defaults={"step" = 1}, options={"expose"=true})
     * @Template()
     */
    public function testAction(Request $request, $test = 'test-1', $step = null){
        $user = $this->getUser();

        if ($step >= 7){
            $testBlock = [];
        }else{
            switch($step){
                case 1: $testBlock = array(
                    'question' => 'question-1',
                    'answers' => array('1', '2', '3')
                );
                    break;
                case 2: $testBlock = array(
                    'question' => 'question-1',
                    'answers' => array('1', '2', '3')
                );
                    break;
                case 3: $testBlock = array(
                    'question' => 'question-1',
                    'answers' => array('1', '2', '3')
                );
                    break;
            }
        }
        return new JsonResponse(array('test' => $testBlock));
    }
}