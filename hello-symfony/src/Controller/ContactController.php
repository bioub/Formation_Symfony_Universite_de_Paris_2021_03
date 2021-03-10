<?php


namespace App\Controller;

use App\Manager\ContactManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContactController
{
    /** @var ContactManager */
    protected $contactManager;

    /**
     * ContactController constructor.
     * @param ContactManager $contactManager
     */
    public function __construct(ContactManager $contactManager)
    {
        $this->contactManager = $contactManager;
    }

    /** @Route("/contacts") */
    public function list()
    {
        $contacts = $this->contactManager->getAll();

        return new JsonResponse($contacts);
    }
}