<?php

namespace App\DataFixtures\ORM;


use App\Entity\Core\Author;
use App\Entity\Core\Category;
use App\Entity\Core\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostsFixtures extends Fixture
{
    /** @var ObjectManager $manager */
    private $manager;

    /**
     * PostsFixtures constructor.
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createPostsData([
            'author' => $this->createAuthor(),
            'categories' => [
                'desarrollo' => $this->createCategory('Desarrollo','desarrollo'),
                'seo' => $this->createCategory('SEO','seo'),
                'blackHat' => $this->createCategory('Black Hat','black-hat'),
                'cursos' => $this->createCategory('Cursos','cursos'),
                'otros' => $this->createCategory('Otros','otros')
            ],
        ]);

        $manager->flush();
    }

    /**
     * @param array $data
     */
    private function createPostsData(array $data)
    {
        $this->createPostsFromArray([
            [
                'title' => 'Cómo hacer una API REST con Node.js',
                'slug' => 'hacer-una-api-rest-con-node-js',
                'author' => $data['author'],
                'category' => $data['categories']['desarrollo']
            ],
            [
                'title' => 'Hacer un vhost en un Nginx sobre Vagrant',
                'slug' => 'thacer-un-vhost-en-nginx-sobre-vagrnt',
                'author' => $data['author'],
                'category' => $data['categories']['seo']
            ],
            [
                'title' => 'Aprende a utilizar mongodb en node js como un PRO',
                'slug' => 'aprende-utilizar-mongodb-en-node-js',
                'author' => $data['author'],
                'category' => $data['categories']['seo']
            ],
            [
                'title' => 'Entendiendo el funcionamiento del protocolo HTTP',
                'slug' => 'entendiendo-protocolo-http',
                'author' => $data['author'],
                'category' => $data['categories']['blackHat']
            ],
            [
                'title' => 'Enlace estático en tiempo de ejecución en la programación orientada a objetos',
                'slug' => 'enlace-estatico-en-tiempo-de-ejecucion',
                'author' => $data['author'],
                'category' => $data['categories']['cursos']
            ],
            [
                'title' => 'Mi top five de herramientas de programación',
                'slug' => 'mi-top-five-de-herramientas-de-programacion',
                'author' => $data['author'],
                'category' => $data['categories']['cursos']
            ],
            [
                'title' => 'Sobrecarga en la programación orientada a objetos',
                'slug' => 'sobrecarga-en-la-programacion',
                'author' => $data['author'],
                'category' => $data['categories']['desarrollo']
            ],
            [
                'title' => 'Cuando Donald Trump se fue de putas en la cama de los Obama',
                'slug' => 'cuando-donald-trump-se-fue-de-putas',
                'author' => $data['author'],
                'category' => $data['categories']['blackHat']
            ],
            [
                'title' => 'Un enlace EDU DOFOLLOW en Academia.edu',
                'slug' => 'enlace-edu-dofollow-en-academia',
                'author' => $data['author'],
                'category' => $data['categories']['cursos']
            ],
            [
                'title' => 'El día que forocoches troleó a un gran partido político',
                'slug' => 'cuando-forocoches-troleo-al-psoe',
                'author' => $data['author'],
                'category' => $data['categories']['cursos']
            ],
            [
                'title' => 'Haciendo magia, enlace en un foro con un DA de 55',
                'slug' => 'enlace-en-un-foro-con-un-da-de-55',
                'author' => $data['author'],
                'category' => $data['categories']['otros']
            ]
        ]);
    }

    /**
     * @param array $data
     */
    private function createPostsFromArray(array $data)
    {
        foreach ($data as $item) {
            $this->createPost($item);
        }
    }

    /**
     * @param $name
     * @param $slug
     * @return Category
     */
    private function createCategory($name, $slug)
    {
        $category = new Category();
        $category->setTitle($name);
        $category->setSlug($slug);

        $this->manager->persist($category);

        return $category;
    }

    /**
     * @return Author
     */
    private function createAuthor()
    {
        $author = new Author();
        $author->setName('Gorkamu');
        $author->setBio('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.');

        $this->manager->persist($author);

        return $author;
    }

    /**
     * @param $args
     * @return Post
     */
    private function createPost( array $args)
    {

        $body = 'Lorem fistrum apetecan elit voluptate ese que llega. Qui diodenoo ese hombree ut ad. Ese hombree magna hasta luego Lucas apetecan al ataquerl aliqua. Jarl no puedor al ataquerl velit laboris laboris et me cago en tus muelas no te digo trigo por no llamarte Rodrigor. Ut torpedo te voy a borrar el cerito qui et qué dise usteer benemeritaar a wan. Ut ese pedazo de veniam pecador jarl ex diodeno esse. Se calle ustée aliquip ese que llega elit va usté muy cargadoo reprehenderit aliquip jarl. Se calle ustée eiusmod la caidita velit papaar papaar amatomaa hasta luego Lucas. Quis ad eiusmod a wan a peich eiusmod aliqua diodenoo veniam quietooor.

Quietooor duis llevame al sircoo sexuarl adipisicing enim diodenoo cillum. Eiusmod incididunt velit consequat ullamco enim hasta luego Lucas. Ahorarr ese hombree sed sed magna diodenoo quis. Commodo quis pupita pupita diodeno. Irure exercitation fistro te va a hasé pupitaa officia reprehenderit la caidita diodeno. De la pradera está la cosa muy malar mamaar aliqua ex eiusmod hasta luego Lucas. Laboris al ataquerl incididunt veniam fistro apetecan por la gloria de mi madre incididunt está la cosa muy malar velit adipisicing. Ad fistro veniam pupita sed enim cillum sexuarl. Incididunt condemor amatomaa enim no puedor va usté muy cargadoo no puedor se calle ustée.

Te voy a borrar el cerito reprehenderit diodeno ut amatomaa officia incididunt. Sit amet me cago en tus muelas de la pradera no te digo trigo por no llamarte Rodrigor aliqua laboris diodeno labore. Hasta luego Lucas qué dise usteer ese pedazo de jarl enim. Ese hombree consectetur apetecan enim tiene musho peligro. Quietooor quietooor jarl dolor aliqua quis no puedor qui qué dise usteer diodenoo laboris. Ut me cago en tus muelas tempor por la gloria de mi madre a peich duis magna consectetur sexuarl. Irure de la pradera de la pradera sit amet quietooor está la cosa muy malar qué dise usteer duis quietooor tempor consectetur.';

        $extract = 'Lorem fistrum apetecan elit voluptate ese que llega. Qui diodenoo ese hombree ut ad. Ese hombree magna hasta luego Lucas ';

        $post = new Post();
        $post->setTitle($args['title']);
        $post->setSlug($args['slug']);
        $post->setBody($body);
        $post->setAuthor($args['author']);
        $post->setStatus(1);
        $post->setExtract($extract);
        $post->setCategory($args['category']);

        $this->manager->persist($post);

        return $post;
    }
}