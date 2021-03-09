<?php

/*
 * Exercice :
 * Créer 3 classes avec les propriétés suivantes
 * User : id (int), firstName (string), lastName (string), email (string), image (string)
 * Post : id (int), title (string), content (string), created (DateTime)
 * Comment : id (int), content (string), created (DateTime)
 *
 * Créer les associations entre ces classes
 * User : posts (Post[]), comments (Comment[])
 * Post : user (User), comments (Comment[])
 * Comment : user (User), post (Post)
 *
 * Générer les getters/setters pour ces classes
 * Remplacer les setComments et setPosts par des "adder"
 *
 * public function setContacts(array $contacts)
 * {
 *    $this->contacts = $contacts
 * }
 *
 * remplacer par
 *
 * public function addContact(Contact $contact)
 * {
 *    $this->contacts[] = $contact;
 * }
 *
 * Créer ensuite un petit programme de test en créant un post
 * lié à un User et à un ensemble de commentaires
 */

