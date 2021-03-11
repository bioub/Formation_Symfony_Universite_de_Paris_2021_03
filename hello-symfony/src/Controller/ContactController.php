<?php


namespace App\Controller;

use App\Manager\ContactManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /** @var ContactManager */
    protected $contactManager;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * ContactController constructor.
     * @param ContactManager $contactManager
     * @param LoggerInterface $logger
     */
    public function __construct(ContactManager $contactManager, LoggerInterface $logger)
    {
        $this->contactManager = $contactManager;
        $this->logger = $logger;
    }


    /** @Route("/contacts") */
    public function list()
    {
        $this->logger->debug('ContactController::list called');
        $contacts = $this->contactManager->getAll();

        return $this->json($contacts);
    }
}