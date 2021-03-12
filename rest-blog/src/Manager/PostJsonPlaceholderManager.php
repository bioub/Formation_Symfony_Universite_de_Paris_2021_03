<?php


namespace App\Manager;


use App\Entity\Post;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PostJsonPlaceholderManager extends PostManager
{
    /** @var HttpClientInterface */
    protected $httpClient;

    /** @var SerializerInterface */
    protected $serializer;

    /**
     * PostJsonPlaceholderManager constructor.
     * @param HttpClientInterface $httpClient
     * @param SerializerInterface $serializer
     */
    public function __construct(HttpClientInterface $httpClient, SerializerInterface $serializer)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    public function getAll(): array
    {
        $response = $this->httpClient->request(
            'GET',
            'http://jsonplaceholder.typicode.com/posts'
        );

        $postsArray = $response->toArray();

        // convertir les clés body retournées par jsonplaceholder en clé content
        // qui sont définies dans entités Post
        foreach ($postsArray as &$post) {
            $post['content'] = $post['body'];
            unset($post['body']);
        }

        $posts = $this->serializer->deserialize(json_encode($postsArray), 'App\Entity\Post[]', 'json');

        return $posts;
    }

    public function getById($id): Post
    {
        return new Post();
    }

    public function create(Post $post): void
    {

    }

}