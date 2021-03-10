<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auth")
 */
class AuthController
{
    /**
     * @Route()
     */
    public function login(): Response
    {
        return new JsonResponse(['msg' => 'auth login']);
    }
}
