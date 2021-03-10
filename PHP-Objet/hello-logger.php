<?php

require_once __DIR__ . '/vendor/autoload.php';

$logger = new \App\Logger\Logger();

// pageContact dépends de Logger
// Bonne pratique : dépendre de l'abstraction (interface,
// classe abstraite) plus que l'implémentation (la classe
// instanciée)

// Principe SOLID

function pageContact(\Psr\Log\LoggerInterface $logger) {
    $logger->debug('Coucou');
}