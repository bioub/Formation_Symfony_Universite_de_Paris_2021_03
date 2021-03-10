<?php


namespace App\Controller;


use App\Logger\Logger;
use App\Writer\FileWriter;
use ProxyManager\ProxyGenerator\LazyLoadingGhost\MethodGenerator\MagicClone;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /** @var Logger */
    protected $logger;

    /**
     * DefaultController constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /** @Route("/")  */
    public function index()
    {
        $this->logger->info('URL : /, controller: DefaultController::index');
        return new Response('Homepage', 200, ['Content-type' => 'text/plain']);
    }

    /** @Route("/api/hello/{name}")  */
    public function helloApiRest($name)
    {

        return new JsonResponse(["msg" => "Hello $name"]);
    }
}