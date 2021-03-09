<?php

require_once __DIR__ . '/classes/Contact.php';

$romain = new Contact();
$romain->setFirstName('Romain')->setLastName('Bohdanowicz');

echo $romain->getFirstName() . "\n";

$eric = new Contact();
$eric->setFirstName('Eric');

echo $eric->getFirstName() . "\n";