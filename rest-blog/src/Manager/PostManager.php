<?php


namespace App\Manager;


use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

class PostManager
{
    /** @var PostRepository */
    protected $postRepository;

    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(PostRepository $postRepository, EntityManagerInterface $entityManager)
    {
        $this->postRepository = $postRepository;
        $this->entityManager = $entityManager;
    }

    public function getAll(): array
    {
        return $this->postRepository->findBy([], [], 100);
    }

    public function getByTitle($title): array
    {
        return $this->postRepository->findByTitle($title);
    }

    public function getById($id): Post
    {
        return $this->postRepository->find($id);
    }

    public function create(Post $post): void
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}