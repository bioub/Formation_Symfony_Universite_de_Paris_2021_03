<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts")
 */
class PostController
{
    /**
     * @Route(methods={"GET"})
     */
    public function list(): Response
    {
        return new JsonResponse(['msg' => 'posts list']);
    }

    /**
     * @Route(methods={"POST"})
     */
    public function create(): Response
    {
        return new JsonResponse(['msg' => 'posts create']);
    }

    /**
     * @Route("/{postId}", methods={"GET"})
     */
    public function show($postId): Response
    {
        return new JsonResponse(['msg' => "posts show $postId"]);
    }
}
