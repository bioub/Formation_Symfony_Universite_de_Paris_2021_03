<?php

namespace App\Controller;

use App\Entity\Post;
use App\Manager\PostManager;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/posts")
 */
class PostController extends AbstractController
{
    /** @var PostManager */
    protected $postManager;

    /** @var UserManager */
    protected $userManager;

    /**
     * PostController constructor.
     * @param PostManager $postManager
     * @param UserManager $userManager
     */
    public function __construct(PostManager $postManager, UserManager $userManager)
    {
        $this->postManager = $postManager;
        $this->userManager = $userManager;
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
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        $post = $serializer->deserialize($request->getContent(), Post::class, 'json');
        // $post->setCreated(new \DateTime());

        $errors = $validator->validate($post);

        if (count($errors)) {
            return $this->json($errors, 422);
        }

        if ($post->getUser()) {
            $user = $this->userManager->getById($post->getUser()->getId());
            $post->setUser($user);
        }

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
