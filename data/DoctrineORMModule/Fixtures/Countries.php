<?php

namespace DoctrineORMModule\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Application\Entity\Country;

class Countries extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $countries = include __DIR__ . '/countries.php';

        $rep = $manager->getRepository('Application\Entity\Country');

        foreach ($countries as $item) {
            $country = $rep->findOneByAlpha2($item['alpha2']);
            if (null === $country) {
                $country = new Country($item);
                $manager->persist($country);
            }
            $this->addReference($item['alpha2'], $country);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
