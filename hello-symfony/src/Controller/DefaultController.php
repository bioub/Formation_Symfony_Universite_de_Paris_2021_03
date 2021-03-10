<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /** @Route("/")  */
    public function index()
    {
        return new Response('Homepage', 200, ['Content-type' => 'text/plain']);
    }

    /** @Route("/api/hello/{name}")  */
    public function helloApiRest($name)
    {
        return new JsonResponse(["msg" => "Hello $name"]);
    }
}