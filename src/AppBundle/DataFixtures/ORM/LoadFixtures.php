<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use AppBundle\Entity\Book;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
		$this->loadBooks($manager);
    }

    private function loadBooks(ObjectManager $manager)
    {
        for ($i=0;$i<20;$i++) {
            $book = new Book();
            $book->setName('Foo Bar');
            $book->setPrice('19.99');
            $manager->persist($book);
        }

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

		$tonyAdmin = new User();
        $tonyAdmin->setName('Tony');
        $tonyAdmin->setSurname('Master');
        $tonyAdmin->setUsername('tony_admin');
	    $tonyAdmin->setEmail('tony_admin@symfony.com');
		$tonyAdmin->setRoles(['ROLE_ADMIN']);
        $encodedPassword = $passwordEncoder->encodePassword($tonyAdmin, 'master');
       	$tonyAdmin->setPassword($encodedPassword);
        $manager->persist($tonyAdmin);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
