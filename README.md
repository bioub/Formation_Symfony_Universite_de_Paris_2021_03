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

