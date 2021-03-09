<?php

require_once __DIR__ . '/classes/Contact.php';

$s1 = 'Romain';
$s2 = $s1; // recopier la valeur
//$s2 = &$s1; // créer et affecter une référence
$s2 = 'Eric';
echo $s1 . "\n";

$o1 = new Contact();
$o1->setFirstName('Romain');
$o2 = $o1; // recopier la réference
//$o2 = clone $o1; // cloner et recopier la nouvelle réference
$o2->setFirstName('Eric');
echo $o1->getFirstName() . "\n";