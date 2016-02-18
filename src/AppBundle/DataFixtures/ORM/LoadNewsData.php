<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Publication;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNewsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 3 ; $i ++ ){

            $new = new Publication();
            $new->setSlug('new-'.$i);
            $new->setTitle('Мизулина предлагает оградить российских детей от пагубного влияния онлайн видеоигр');
            $new->setBody('Мерило нравственности и блюститель духовных скреп российских граждан, Елена Борисовна Мизулина
                        возвращается на законодательное поле боя с новой инициативой — оградить российских детей от
                        «плохих» онлайн видеоигр');
            $new->setCreated(new \DateTime('20.03.1016'));
            $manager->persist($new);
            $manager->flush();

        }
    }
}