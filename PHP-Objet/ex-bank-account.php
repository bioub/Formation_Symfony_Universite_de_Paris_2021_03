<?php

require_once __DIR__ . '/classes/BankAccount.php';

$bankAccount = new BankAccount();
$bankAccount->setProprietaire('Jean');
$bankAccount->setSolde(1000);

$bankAccount->crediter(300);
echo $bankAccount->getSolde(); // 1300

$bankAccount->debiter(100);
echo $bankAccount->getSolde(); // 1200

/*
 * Exercice :
 * Sans toucher au fichier ex-bank-account.php
 * Modifier la classe BankAccount
 * Créer 2 propriété : proprietaire (string), solde (double)
 * Générer les getters/setters
 * Créer les méthodes crediter et debiter qui mettent à jour le solde
 * Empeche qu'on puisse passer des montant négatifs à crediter/debiter
 */