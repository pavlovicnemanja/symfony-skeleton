<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setFirstname('Test');
        $user->setLastname('NinePixels');
        $user->setEmail('test@ninepixels.app');
        $user->setPassword($this->passwordHasher->hashPassword(
            $user, 'testpassword123'
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
