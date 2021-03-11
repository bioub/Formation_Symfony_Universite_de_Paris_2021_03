<?php

namespace App\Controller;

use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users")
 */
class UserController extends AbstractController
{
    /** @var UserManager */
    protected $userManager;

    /**
     * UserController constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @Route(methods={"GET"})
     */
    public function list(): Response
    {
        $data = $this->userManager->getAll();
        return $this->json($data);
    }

    /**
     * @Route("/{userId}", methods={"GET"})
     */
    public function show($userId): Response
    {
        $data = $this->userManager->getById($userId);
        return $this->json($data);
    }
}
