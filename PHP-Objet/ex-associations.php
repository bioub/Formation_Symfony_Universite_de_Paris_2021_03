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


require_once 'classes/User.php';
require_once 'classes/Post.php';
require_once 'classes/Comment.php';

$post = new Post();
$post->setId(1)
    ->setTitle('ABC')
    ->setContent('lorem ipsum')
    ->setCreated(new DateTime());

$user = new User();
$user->setId(1)
    ->setFirstName('A')
    ->setLastName('B')
    ->setEmail('a@b.fr')
    ->setImage('uploads/photo.jpg');

$post->setUser($user);

$comment1 = new Comment();
$comment1->setContent('ABC')
         ->setUser($user)
        ->setCreated(new DateTime());

$comment2 = new Comment();
$comment2->setContent('DEF')
    ->setUser($user)
    ->setCreated(new DateTime());

$post->addComment($comment1);
$post->addComment($comment2);

var_dump($post);