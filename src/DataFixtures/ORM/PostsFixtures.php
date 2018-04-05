<?php

namespace App\DataFixtures\ORM;


use App\Entity\Core\Author;
use App\Entity\Core\Category;
use App\Entity\Core\Post;
use App\Entity\Core\Site;
use App\Entity\Core\Tag;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostsFixtures extends Fixture
{
    /** @var ObjectManager $manager */
    private $manager;

    /**
     * PostsFixtures constructor.
     * @param ObjectManager $manager
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
     * @param $title
     * @param $slug
     * @param $category
     * @return array
     */
    private function createPostArray($title, $slug, $category, $author)
    {
        return [
            'title' => $title,
            'slug' => $slug,
            'category' => $category,
            'author' => $author
        ];
    }

    /**
     * @param array $data
     */
    private function createPostsData(array $data)
    {
        $this->createPostsFromArray([
            $this->createPostArray('Cómo hacer una API REST con Node.js', 'hacer-una-api-rest-con-node-js', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Hacer un vhost en un Nginx sobre Vagrant', 'thacer-un-vhost-en-nginx-sobre-vagrnt', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Aprende a utilizar mongodb en node js como un PRO', 'aprende-utilizar-mongodb-en-node-js', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Entendiendo el funcionamiento del protocolo HTTP', 'entendiendo-protocolo-http', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Enlace estático en tiempo de ejecución en la programación orientada a objetos', 'enlace-estatico-en-tiempo-de-ejecucion', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Mi top five de herramientas de programación', 'mi-top-five-de-herramientas-de-programacion', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Sobrecarga en la programación orientada a objetos', 'sobrecarga-en-la-programacion', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Cuando Donald Trump se fue de putas en la cama de los Obama', 'cuando-donald-trump-se-fue-de-putas', $data['categories']['seo'], $data['author']),
            $this->createPostArray('El día que forocoches troleó a un gran partido político', 'cuando-forocoches-troleo-al-psoe', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Otro post mas', 'otro-post-mas', $data['categories']['seo'], $data['author']),
            $this->createPostArray('Walk Otro post mas', ' Walk otro-post-mas', $data['categories']['seo'], $data['author']),
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
        $author->setSlug('gorkamu');
        $author->setBio('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.');

        $this->manager->persist($author);

        return $author;
    }

    /**
     * @param $args
     * @return Post
     */
    private function createPost(array $args)
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

        $date = new DateTime();

        $post->addTag($this->createTag('programacion'.rand(0, $date->getTimestamp())));
        $post->addTag($this->createTag('php'.rand(0, $date->getTimestamp())));
        $post->addTag($this->createTag('git'.rand(0, $date->getTimestamp())));

        $this->manager->persist($post);

        return $post;
    }

    /**
     * @param $title
     * @return Tag
     */
    private function createTag($title)
    {
        $tag = new Tag();
        $tag->setTitle($title);
        $tag->setSlug($title);

        $this->manager->persist($tag);

        return $tag;
    }
}