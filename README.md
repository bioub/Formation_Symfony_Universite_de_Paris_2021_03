# Exercices Symfony

## Créer un projet symfony

Comme vu pendant la formation, créer un projet Symfony qui utilise le squelette complet (website/skeleton) appelé `rest-blog`

## Importer les entités

Importer les entités créées dans le projet `PHP-Objet` dans `src/Entity` (classes `Post`, `User` et `Comment`)

## Créer les classes Controller

Créer les classes suivantes dans le dossier `Controller` :

- `PostController`
- `UserController`
- `AuthController`

Dans `PostController` créer les routes suivantes retourner pour l'instant une `JSONResponse` avec un message différent dans chaque route.

- `GET /posts` : `list()`
- `POST /posts`: `create()`
- `GET /posts/123` : `show()` où 123 est l'id du Post (utiliser un paramètre)


Créer les routes suivantes dans `UserController` :

- `GET /users` : `list()`
- `GET /users/123` : `show()` où 123 est l'id du User (utiliser un paramètre)

Créer la route suivante dans `AuthController` :

- `GET /auth` -> `login()`

## Créer les classes Manager

Dans le dossier src, créer un sous-dossier Manager

Y créer 2 classes : PostManager et UserManager

Dans PostManager, créer 3 méthodes

- getAll -> retourne un tableau d'entité Post
- getById -> reçoit en entrée un id et retourne une entité Post (quelconque, pas besoin que l'id corresponde)
- create -> reçoit en entrée un Post mais ne retourne rien

Dans UserManager, créer 2 méthodes sur le meme modèle :

- getAll
- getById

Dans PostController, injecter la dépendence PostManager, en créant une propriété $postManager et en générant un constructeur avec cette propriété

Appeler les méthodes getAll dans list et retourner les Posts en JsonResponse.

Dans create, créer un objet Post le passer au Manager et retourner cet objet en JsonResponse.

Injecter ensuite UserManager dans UserController sur le même modèle.

## Doctrine Basic Mapping

Editer la variable `DATABASE_URL` du fichier `.env` pour la faire pointer vers une nouvelle base `blog_symfony`

Créer cette base avec la commande :

`bin/console doctrine:database:create`

Ajouter les annotations Doctrine dans les classes `User`, `Comment` et `Post`

Pour l'instant on ne s'occupe pas des associations.

Au dessus des classes pensez à `@ORM\Entity`

Pour les propriétés `$id` : `@ORM\Id`, `@ORM\GeneratedValue`, `@ORM\Column`

Pour `Post` :

- `id` est de type `integer`
- `title` est de type `string`
- `content` est de type `text`
- `created` est de type `datetime`

Pour `Comment` :

- `id` est de type `integer`
- `content` est de type `text`
- `created` est de type `datetime`

Pour `User` :

- `id` est de type `integer`
- `firstName` est de type `string`
- `lastName` est de type `string`
- `email` est de type `string`
- `image` est de type `string`

Supprimer les getters/setters et regénérez les avec la commande :

`bin/console make:entity --regenerate`

Vérifier le script de création de table avec :

`bin/console doctrine:schema:update --dump-sql`

Puis créer les tables avec :

`bin/console doctrine:schema:update --force`

Installer ensuite `orm-fixtures` et `fzaninotto/faker` :

`composer require orm-fixtures fzaninotto/faker`

Utiliser cette classe pour les fixtures :

```
<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        /** @var User[] $users */
        $users = [];

        /** @var Post[] $posts */
        $posts = [];

        /** @var Comment[] $comments */
        $comments = [];


        for ($i = 0; $i < 5; $i++)
        {
            $user = new User();
            $user->setFirstName($faker->firstName())
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setImage($faker->imageUrl());

            $users[] = $user;

            $manager->persist($user);
        }


        for ($i = 0; $i < 20; $i++)
        {
            $post = new Post();
            $post->setTitle(implode(' ', $faker->words(mt_rand(0, 10))))
                ->setContent($faker->paragraph())
                ->setCreated($faker->dateTimeBetween('2021-01-01', '2021-01-31'));

            $user = $users[mt_rand(0, 4)];

            // Associations
            // $post->setUser($user);

            $posts[] = $post;

            $manager->persist($post);
        }


        for ($i = 0; $i < 30; $i++)
        {
            $post = $posts[mt_rand(0, 9)];
            $user = $users[mt_rand(0, 4)];

            $comment = new Comment();
            $comment->setContent($faker->sentence())
                ->setCreated($faker->dateTimeBetween($post->getCreated(), '2021-01-31'));

            // Associations
            // $comment->setPost($post);
            // $comment->setUser($user);

            $comments[] = $comment;

            $manager->persist($comment);
        }

        $manager->flush();
    }
}
```

Puis générer les fixtures avec :

`bin/console doctrine:fixtures:load`

