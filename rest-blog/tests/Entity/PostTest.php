<?php

namespace App\Tests\Entity;

use App\Entity\Post;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function testTitle(): void
    {
        $post = new Post();
        $post->setTitle('ABC');
        $this->assertEquals('ABC', $post->getTitle());
    }
}
