<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Video;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadVideoData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 2 ; $i ++ ){

            $new = new Video();
            $new->setTitle('Видео 1');
            $new->setBody('Мерило нравственности и блюститель духовных скреп российских граждан, Елена Борисовна Мизулина
                        возвращается на законодательное поле боя с новой инициативой — оградить российских детей от
                        «плохих» онлайн видеоигр');

            $new->setCreated(new \DateTime('20.03.1016'));
            $new->setEnabled(true);
            $new->setVideo(array('path' => 'd'));
            $manager->persist($new);
            $manager->flush();

        }
    }
}