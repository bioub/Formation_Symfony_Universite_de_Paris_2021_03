<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        /** @var User[] $users */
        $users = [];

        /** @var Post[] $posts */
        $posts = [];

        /** @var Comment[] $comments */
        $comments = [];


        for ($i = 0; $i < 5; $i++)
        {
            $user = new User();
            $user->setFirstName($faker->firstName())
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setImage($faker->imageUrl());

            $users[] = $user;

            $manager->persist($user);
        }


        for ($i = 0; $i < 20; $i++)
        {
            $post = new Post();
            $post->setTitle(implode(' ', $faker->words(mt_rand(0, 10))))
                ->setContent($faker->paragraph())
                ->setCreated($faker->dateTimeBetween('2021-01-01', '2021-01-31'));

            $user = $users[mt_rand(0, 4)];

            // Associations
            // $post->setUser($user);

            $posts[] = $post;

            $manager->persist($post);
        }


        for ($i = 0; $i < 30; $i++)
        {
            $post = $posts[mt_rand(0, 9)];
            $user = $users[mt_rand(0, 4)];

            $comment = new Comment();
            $comment->setContent($faker->sentence())
                ->setCreated($faker->dateTimeBetween($post->getCreated(), '2021-01-31'));

            // Associations
            // $comment->setPost($post);
            // $comment->setUser($user);

            $comments[] = $comment;

            $manager->persist($comment);
        }

        $manager->flush();
    }
}