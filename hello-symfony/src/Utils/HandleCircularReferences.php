<?php


namespace App\Utils;


class HandleCircularReferences
{
    public function __invoke($object)
    {
        return ['id' => $object->getId()];
    }

}