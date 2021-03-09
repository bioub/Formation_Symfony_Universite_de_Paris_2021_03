<?php

use App\Hello\Contact;

require_once __DIR__ . '/vendor/autoload.php';

$romain = new Contact();
$romain->setFirstName('Romain')->setLastName('Bohdanowicz');

echo $romain->getFirstName() . "\n";

$eric = new Contact();
$eric->setFirstName('Eric');

echo $eric->getFirstName() . "\n";