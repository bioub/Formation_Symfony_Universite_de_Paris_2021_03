<?php

require_once __DIR__ . '/classes/Contact.php';

$romain = new Contact();
$romain->setFirstName('Romain');

echo $romain->getFirstName() . "\n";