<?php

namespace App\Manager;

use App\Entity\Contact;

class ContactManager
{
    public function getAll()
    {
        return [
            (new Contact())->setFirstName('A'),
            (new Contact())->setFirstName('B'),
        ];
    }
}