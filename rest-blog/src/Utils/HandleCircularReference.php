<?php

namespace App\Utils;

class HandleCircularReference
{
    public function __invoke($object, $format, $context)
    {
        return ["id" => $object->getId()];
    }
}