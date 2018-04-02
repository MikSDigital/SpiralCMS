<?php

namespace App\DataFixtures\ORM;


use App\Entity\Core\Author;
use App\Entity\Core\Category;
use App\Entity\Core\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author->setName('Gorkamu');
        $author->setBio('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.');
        $manager->persist($author);

        $desarrollo = $this->createCategory('Desarrollo','desarrollo');
        $manager->persist($desarrollo);

        $seo = $this->createCategory('SEO','seo');
        $manager->persist($seo);

        $post = new Post();
        $post->setTitle('Cómo hacer una API REST con Node.js');
        $post->setSlug('hacer-una-api-rest-con-node-js');
        $post->setBody('En artículos anteriores hemos visto cómo hacer la primera configuración de las herramientas que vamos a instalar así como a organizar nuestro proyecto utilizando el patrón Modelo-Vista-Controlador. Pues bien, hoy toca entrar en materia y vamos a comenzar a hacer una API REST con Node.js.

Un primer paso necesario para seguir estudiando Node.js y una buena base para que después podamos crear una aplicación SPA, o consultar la API desde un proyecto Symfony o para hacer que nuestra aplicación móvil pueda explotar esos datos oooo yo que sé.... las posibilidades son infinitas así que empecemos!
<h5>Cómo hacer una API REST con Node.js</h5>
A lo mejor a mas de uno esto de hacer una API REST con Node le suena a chino así que lo mejor que podemos hacer es ver primeramente qué es eso de una API REST.
<h5>¿Qué es una API REST?</h5>
Pues es lo que se conoce como una interfaz de comunicación entre clientes que utilicen el protocolo HTTP. Para que se entienda, es el canal por el cual tu móvil <strong>le dice a los servidores de Clash Royale que has abierto un cofre</strong> y te ha tocado el mago eléctrico o por ejemplo es el canal que utiliza Instragram para subir las fotos que haces con tu smartphone a sus servidores.

¿Se entiende el concepto?

Hoy en día podemos encontrar usos de APIs en casi toda cosa tecnológica que nos imaginemos pero el concepto de API no es nuevo ya que hace años existía otro tipo de APIs que parecía ser el rey del desarrollo. Hablo de SOAP y su intercambio de datos mediante XML. Hasta que debido a su facilidad llegaron las API REST y el intercambio mediante JSON.

Principalmente con una API REST vamos a echar mano de lo que se conoce como verbos HTTP. En concreto 4 y cada uno de estos verbos los utilizaremos para una acción u operación diferente con los datos que queremos manipular.

Así pues:
<br><ul>
 	<li>Cuando queramos <strong>subir una imagen nueva</strong> a Instragram utilizaremos el <strong>método POST</strong> del protocolo HTTP.</li>
 	<li>Cuando queramos <strong>saber cuántos seguidores tenemos</strong> en Twitter utilizaremos el <strong>método GET</strong> del protocolo HTTP.</li>
 	<li>Cuando queramos <strong>eliminar nuestro último estado</strong> de Facebook utilizaremos el <strong>método DELETE</strong> del protocolo HTTP.</li>
 	<li>Cuando queramos <strong>actualizar la foto de perfil</strong> de Snapchat utilizaremos el<strong> método PUT</strong> del protocolo HTTP.</li>
 	<li>Cuando queramos <strong>ver la lista de seguidores</strong> de VK utilizaremos el <strong>método GET</strong> del protocolo HTTP.</li>
</ul>
<br>
Hasta aquí esto es lo mínimo que podemos hacer con una API REST pero si quieres saber mas te recomiendo que le eches un vistazo a <a href="https://bbvaopen4u.com/es/actualidad/api-rest-que-es-y-cuales-son-sus-ventajas-en-el-desarrollo-de-proyectos">este artículo</a> en el que se explica muy bien toda esta película, que nosotros nos vamos a poner a hacer ya una API REST con Node.js :D
<h5>Cuatro verbos para dominarlos a todos</h5>
¿Os acordáis de la aplicación sobre álbumes musicales que empezamos a crear en los artículos anteriores? Si no te acuerdas o todavía no los has visto retrocede un poquito en el tiempo desde este enlace y desde este y cuando los hayas terminado vuelve aquí para seguir con la API REST con Node.js

Pero para el que si que se acuerde mediante el patrón MVC llegamos a organizar los ficheros de nuestro proyecto de una forma lógica y funcional ¿no?

También te acordarás de que hicimos un pequeño controlador para probar ¿no? De hecho llegamos a definir los métodos mínimos que tiene que tener nuestra API pero la gran mayoría de estos métodos lo único que hacia era recibir los datos de la <em>request</em> y devolverlos en la <em>response</em>. No había lógica de negocio alguna.');
        $post->setAuthor($author);
        $post->setStatus(1);
        $post->setExtract('En artículos anteriores hemos visto cómo hacer la primera configuración de las herramientas que vamos a instalar así como a organizar');
        $post->setCategory($seo);
        $manager->persist($post);

        $blackHat = $this->createCategory('Black Hat','black-hat');
        $manager->persist($blackHat);

        $post = new Post();
        $post->setTitle('Hacer un vhost en un Nginx sobre Vagrant');
        $post->setSlug('thacer-un-vhost-en-nginx-sobre-vagrnt');
        $post->setBody('Qué pasa chumachos? Tenéis ganas de aprender a hacer un vhost sobre servidores Nginx? Si? Pues allá vamos.

Hoy os vengo con otro post técnico. En este artículo veremos cómo <strong>hacer un vhost</strong> en un servidor Nginx montado sobre un Vagrant. Toma ya menudo jaleo de palabras xD. Si las conoces y no estas con cara de WTF continúa leyendo.

Lo primero que necesitaremos será tener instalado Vagrant. Pero para el que no lo sepa, vamos a ver qué es Vagrant y qué dice su documentación oficial:
<blockquote>Create and configure lightweight, reproducible, and portable development environments.</blockquote>
O dicho de otro modo, con Vagrant montaremos una máquina virtual en la que tendremos instalado un servidor web (Nginx), PHP, Mysql y el resto de software que nos haga falta.

Para instalar Vagrant solo nos tenemos que venir a la <a href="https://www.vagrantup.com/downloads.html">página de descargas</a> y seleccionar el paquete que necesitemos para nuestros sistemas operativos. En mi caso elegí el paquete para arquitecturas de 64 bits con Debian. Esto te descarga un .deb con el que instalar Vagrant de forma super sencilla mediante el Gestor de Software de Linux.

Siguiente paso, instalar VirtualBox, pero...
<h2>¿qué es VirtualBox?</h2>
Pues VirtualBox es el software que vamos a utilizar para montar esa máquina virtual en la que desplegar el entorno de desarrollo. También hay otro software para la creación de máquinas virtuales como por ejemplo Vmware, pero para hacerlo funcionar bien sin problemas con Vagrant usaremos VirtualBox.

Para descargar VirtualBox os tenéis que venir a la <a href="https://www.virtualbox.org/wiki/Downloads">página de descargas</a> y buscar el binario que necesitéis o que os pida vuestro ordenador por eso que es muy importante que conozcáis la arquitectura que tengáis.

Una vez que ya tengáis instalado VirtualBox y Vagrant instalado os podéis clonar <a href="https://github.com/varying-vagrant-vagrants/vvv/">esta <em>vagrant-box</em></a> que ya viene preparada para desarrollar plugins y temas para Wordpress. Este es el software que trae la máquina:
<ul>
 	<li>Ubuntu 14.04 LTS (Trusty Tahr)</li>
 	<li>WordPress Develop</li>
 	<li>WordPress Stable</li>
 	<li>WordPress Trunk</li>
 	<li>WP-CLI (master branch)</li>
 	<li>nginx (mainline version)</li>
 	<li>mysql 5.5.x</li>
 	<li>php-fpm 7.0.x</li>
 	<li>memcached</li>
 	<li>PHP memcache extension</li>
 	<li>PHP xdebug extension</li>
 	<li>PHP imagick extension</li>
 	<li>PHPUnit</li>
 	<li>ack-grep</li>
 	<li>git</li>
 	<li>subversion</li>
 	<li>ngrep</li>
 	<li>dos2unix</li>
 	<li>Composer</li>
 	<li>phpMemcachedAdmin</li>
 	<li>phpMyAdmin (multi-language)</li>
 	<li>Opcache Status</li>
 	<li>Webgrind</li>
 	<li>NodeJs</li>
 	<li>grunt-cli</li>
 	<li>Mailcatcher</li>
</ul>
Con esta máquina solo te tienes que preocupar de levantarla y liarte a programar. Fin.');
        $post->setAuthor($author);
        $post->setStatus(1);
        $post->setExtract('Qué pasa chumachos? Tenéis ganas de aprender a hacer un vhost sobre servidores Nginx? Si? Pues allá vamos.

Hoy os vengo con otro post técnico.');
        $post->setCategory($blackHat);
        $manager->persist($post);

        $cursos = $this->createCategory('Cursos','cursos');
        $manager->persist($cursos);

        $otros = $this->createCategory('Otros','otros');
        $manager->persist($otros);

        $post = new Post();
        $post->setTitle('Superenlace para hacer backlinking');
        $post->setSlug('superenlace-para-hacer-backlinking');
        $post->setBody('Que pasa chumachos!

Vengo otra vez con otro artículo rapidito de linkbuilding, de esos que utilizo para sacarme una publicación de la manga y mantener así el calendario semanal pero, en este caso el sitio que os voy a enseñar tiene unas métricas que os hará el culo pepsicola.

Se trata de dejar un enlace en <a href="https://jsfiddle.net">Jsfiddle</a> y para el que no lo conozca se trata de una plataforma que te proporciona un sandbox o entorno de pruebas para poder probar pequeños snippets de código. Totalmente orientado el frontend ya que "solo" te deja probar HTML, CSS y JS.

Jsfiddle te deja probar código sin la necesidad de registrarte pero si lo haces accederás a un montón de funcionalidades bastante chulas y de hecho tienen por <a href="https://trello.com/b/LakLkQBW/jsfiddle-roadmap">ahí un tablero</a> en el que puedes ir viendo el seguimiento del proyecto.

Bueno, ahora que ya conoces la plataforma muy por encima vamos a lo que nos interesa, conseguir ese esperado <strong>enlace dofollow con una autoridad de página de 87 y una autoridad de dominio de 84</strong>. Toma ya!

<img class="aligncenter" src="https://media.giphy.com/media/xT77XWum9yH7zNkFW0/giphy.gif" width="500" height="281" />

Una vez entres en Jsfiddle verás que el espacio de trabajo se divide en cuatro tableros. Arriba a la izquierda para el código HTML, arriba a la derecha para los estilos CSS, abajo a la izquierda para el Javascript y abajo a la derecha mostrará el resultado. Pues es en el cuadrante del HTML dónde dejaremos nuestro enlace.

Con escribir una línea de código será mas que suficiente.

[caption id="attachment_2225" align="alignnone" width="1006"]<a href="http://gorkamu.com/?attachment_id=2225" rel="attachment wp-att-2225"><img class="size-full wp-image-2225" src="http://gorkamu.com/wp-content/uploads/2016/10/enlace.png" alt="Las tripas de nuestro super enlace dofollow" width="1006" height="59" /></a> Las tripas de nuestro super enlace dofollow[/caption]

Una vez le des al botón de <em>Run</em> verás el enlace en funcionamiento en el cuadrante de los resultados (abajo a la derecha) y si no me creéis podéis inspeccionar con las herramientas para desarrolladores para ver que se trata realmente de un enlace dofollow.');
        $post->setAuthor($author);
        $post->setStatus(1);
        $post->setExtract('Vengo otra vez con otro artículo rapidito de linkbuilding, de esos que utilizo para sacarme una publicación de la manga y mantener así el ');
        $post->setCategory($otros);
        $manager->persist($post);

        $manager->flush();
    }

    private function createCategory($name, $slug)
    {
        $category = new Category();
        $category->setTitle($name);
        $category->setSlug($slug);

        return $category;
    }
}