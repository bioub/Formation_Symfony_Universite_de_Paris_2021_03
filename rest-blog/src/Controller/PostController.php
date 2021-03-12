<?php

namespace App\Controller;

use App\Entity\Post;
use App\Manager\PostManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/posts")
 */
class PostController extends AbstractController
{
    /** @var PostManager */
    protected $postManager;

    /**
     * PostController constructor.
     * @param PostManager $postManager
     */
    public function __construct(PostManager $postManager)
    {
        $this->postManager = $postManager;
    }

    /**
     * @Route(methods={"GET"})
     */
    public function list(): Response
    {
        $data = $this->postManager->getAll();
        return $this->json($data);
    }

    /**
     * @Route(methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer): Response
    {
        $post = $serializer->deserialize($request->getContent(), Post::class, 'json');
        $post->setCreated(new \DateTime());

        $this->postManager->create($post);

        return $this->json($post);
    }

    /**
     * @Route("/{postId}", methods={"GET"})
     */
    public function show($postId): Response
    {
        $data = $this->postManager->getById($postId);
        return $this->json($data);
    }
}
