<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $users = 
        [
            [
                'email' => 'adminsite@gmail.com',
                'password' => '$2y$13$eQ5Tbb74HZzxinNEMtDyV.moLV0RDorq663isoVKgZgk.TEFhCkXa',
                'role' => 'ROLE_ADMIN',
            ],
            [
                'email' => 'user@gmail.com',
                'password' => '$2y$13$2.4m9Vqa/z/kuPFax0dKceYthnP7rHMko0tFX1quYSaWlm8StQJE.',
                'role' => 'ROLE_USER',
            ],
        ];

        $userObjects = [];
        for($i = 0; $i <= 1 ; $i++)
        {
            $user = new User;
            $user->setEmail($users[$i]['email']);
            $user->setPassword($users[$i]['password']);
            $user->setRoles([$users[$i]['role']]);
            $userObjects[] = $user;
            $manager->persist($user);
        }

        for($c = 0; $c <= 10; $c++){
            $article = new Article;
            $article->setTitle('Article '.$c);
            $article->setDescription($faker->sentence());
            $randomIndex = array_rand($userObjects);
            $article->setUser($userObjects[$randomIndex]);
            $manager->persist($article);
        }
        $manager->flush();
    }
}
