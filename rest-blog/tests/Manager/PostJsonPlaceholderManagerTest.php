<?php

namespace App\Tests\Manager;

use App\Manager\PostJsonPlaceholderManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class PostJsonPlaceholderManagerTest extends TestCase
{
    public function testGetAll(): void
    {
        $responses = [
            new MockResponse('[{"id": 1, "title": "ABC", "body": "DEF"}]'),
        ];
        $mockHttpClient = new MockHttpClient($responses);
        $encoders = [new JsonEncoder()];
        $normalizers = [new GetSetMethodNormalizer(), new ArrayDenormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $manager = new PostJsonPlaceholderManager($mockHttpClient, $serializer);

        $posts = $manager->getAll();

        $this->assertCount(1, $posts);
        $this->assertEquals("ABC", $posts[0]->getTitle());
    }
}
