<?php

use App\Writer\FileWriter;

require_once __DIR__ . '/vendor/autoload.php';

$fileWriter = new FileWriter('app.log', 'a');
$logger = new \App\Logger\Logger($fileWriter);

// pageContact dépends de Logger
// Bonne pratique : dépendre de l'abstraction (interface,
// classe abstraite) plus que l'implémentation (la classe
// instanciée)

// Principe SOLID

function pageContact(\Psr\Log\LoggerInterface $logger) {
    $logger->debug('Coucou');
}