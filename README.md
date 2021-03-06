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

## Doctrine queries

Créer les classes `PostRepository`, `UserRepository` (vous pouvez vous inspirez d'une nouvelle entité créée avec la commande `bin/console make:entity`)

Ajouter ces classes dans l'annotation `@Entity` des entités correspondantes via le paramètre `repositoryClass`

Injecter `PostRepository` dans `PostManager` et `UserRepository` dans `UserManager`

Appeler les méthodes du repository pour lire les entités (dans `getAll` et `getById`)

Dans `PostManager` injecter l'entity manager de Doctrine en vérifiant au préalable avec `bin/console debug:container` le nom de la classe ou l'interface enregistrée dans le conteneur.

Appeler les méthodes de l'entity manager dans la méthode `create` de `PostManager`

Tester ensuite avec Postman que vos routes répondent les données en provenance de la base de données.

## Doctrine associations

Supprimer les associations créées dans le projet PHP-Objet (comments, user, posts)

Créer une association bidirectionnelle `ManyToOne` et `OneToMany` entre `Post` et `User`

Créer une association bidirectionnelle `ManyToOne` et `OneToMany` entre `Comment` et `Post`

Modifier ensuite la classe `App\DataFixture\AppFixtures` pour qu'elle créé des liens entre, en prenant aléatoirement des `Post` et des `User`, exemple :

```
$post->setUser($user);
$comment->setPost($post);
```

Regenerer les fixtures avec `bin/console doctrine:fixture:load`

Si vous testez vos routes, vous devriez avoir une erreur de références circulaires.

Créer la classe `App\Utils\HandleCircularReference` :

```
<?php

namespace App\Utils;

class HandleCircularReference
{
    public function __invoke($object, $format, $context)
    {
        return ["id" => $object->getId()];
    }
}
```

Dans le fichier `config/framework.yaml` enregistrer cette classe :

```
serializer:
    circular_reference_handler: App\Utils\HandleCircularReference
```

## Tests Automatisés

Compléter les tests unitaires dans `tests/Entity/PostTest.php` en testant les propriétés `id` et `content`

Dans `tests/Manager/PostJsonPlaceholderManagerTest.php` remplacer les lignes :

```
$encoders = [new JsonEncoder()];
$normalizers = [new GetSetMethodNormalizer(), new ArrayDenormalizer()];

$serializer = new Serializer($normalizers, $encoders);
```

Par un Spy créé via prophecy sur `Symfony\Component\Serializer\SerializerInterface`, il faudra que la méthode `deserialize` retourne un tableau de `App\Entity\Post` et vérifier quelle soit bien appelée 1 seule fois.

Dans `test/Controller/PostControllerTest.php` créer un test fonctionnel de `POST /contacts` en remplaçant le manager par un Spy comme dans `testList()` (pas besoin de créer de faux Serializer et Validator qui seront injectés par le framework).
