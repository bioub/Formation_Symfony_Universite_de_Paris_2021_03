<?php


namespace App\Manager;


use App\Entity\Post;

class PostManager
{
    public function getAll(): array
    {
        return [
            (new Post())->setId(1)->setTitle('Title 1')->setContent('lorem ipsum 1'),
            (new Post())->setId(2)->setTitle('Title 2')->setContent('lorem ipsum 2'),
        ];
    }

    public function getById($id): Post
    {
        return (new Post())->setId($id)->setTitle('Title 1')->setContent('lorem ipsum 1');
    }

    public function create(Post $post): void
    {
        // TODO INSERT
        $post->setId(1234);
    }
}