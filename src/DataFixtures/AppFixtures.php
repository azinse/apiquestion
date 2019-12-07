<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppFixtures extends Fixture implements ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
    	$this->loadQuestions($manager);
    }

    private function loadQuestions(ObjectManager $manager)
    {
            for ($i = 0; $i < 20; $i++) {
                    $question = new Question();
                    $question->setText('Foo bar'. $i);
                    $question->setCeatedAt(new \DateTime());
                    $question->setChoices([]);
                    $manager->persist($question);
            }

            $manager->flush();

    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
