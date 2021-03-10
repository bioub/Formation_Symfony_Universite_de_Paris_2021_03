<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users")
 */
class UserController
{
    /**
     * @Route(methods={"GET"})
     */
    public function list(): Response
    {
        return new JsonResponse(['msg' => 'users list']);
    }

    /**
     * @Route("/{userId}", methods={"GET"})
     */
    public function show($userId): Response
    {
        return new JsonResponse(['msg' => "users show $userId"]);
    }
}
