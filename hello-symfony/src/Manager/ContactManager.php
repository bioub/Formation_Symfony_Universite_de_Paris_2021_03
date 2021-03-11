<?php

namespace App\Manager;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactManager
{
    /** @var ContactRepository */
    protected $contactRepository;

    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(ContactRepository $contactRepository, EntityManagerInterface $entityManager)
    {
        $this->contactRepository = $contactRepository;
        $this->entityManager = $entityManager;
    }

    public function getAll()
    {
        // return $this->contactRepository->findAll();
        return $this->contactRepository->findBy([/*"firstName" => "Romain"*/], ["firstName" => "ASC"], 100);
    }

    public function getById($id)
    {
        return $this->contactRepository->find($id);
    }

    public function create(Contact $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}