<?php

namespace App\Tests\Controller;

use App\Entity\Post;
use App\Manager\PostManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testList(): void
    {
        $client = static::createClient();

        $spy = $this->prophesize(PostManager::class);

        $spy->getAll()->willReturn([(new Post())->setId(1)->setTitle('ABC')->setContent('DEF')]);

        $client->getContainer()->set(PostManager::class, $spy->reveal());

        $crawler = $client->request('GET', '/posts');

        $this->assertResponseIsSuccessful();
        $this->assertJson('[{"id":1,"title":"ABC","content":"DEF","created":null,"user":null,"comments":[]}]', $client->getResponse()->getContent());
        $spy->getAll()->shouldHaveBeenCalledOnce();
    }
}
