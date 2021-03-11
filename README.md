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

