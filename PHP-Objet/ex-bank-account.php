<?php

use App\Hello\BankAccount;

require_once __DIR__ . '/vendor/autoload.php';

$bankAccount = new BankAccount();
$bankAccount->setProprietaire('Jean');
$bankAccount->setSolde(1000);

try {
    $bankAccount->crediter(300);
    echo $bankAccount->getSolde() . "\n";  // 1300

    $bankAccount->debiter(-100);
    echo $bankAccount->getSolde() . "\n"; // 1200
}
catch (Exception $ex) {
    // gestionnaire (dans symfony l'erreur s'affiche dans un page spécifique)
    echo $ex->getMessage();
}
/*
 * Exercice :
 * Sans toucher au fichier ex-bank-account.php
 * Modifier la classe BankAccount
 * Créer 2 propriété : proprietaire (string), solde (double)
 * Générer les getters/setters
 * Créer les méthodes crediter et debiter qui mettent à jour le solde
 * Empeche qu'on puisse passer des montant négatifs à crediter/debiter
 */