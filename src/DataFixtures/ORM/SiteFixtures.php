<?php


namespace App\DataFixtures\ORM;

use App\Entity\Core\Site;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SiteFixtures extends Fixture
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
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $site = $this->createSite();
        $this->manager->persist($site);
        $manager->flush();
    }

    /**
     * @return Site
     */
    private function createSite()
    {
        $site = new Site();
        $site->setName('Gorkamu');
        $site->setSlug('gorkamu.com');
        $site->setDescription('Description for Gorkamu (gorkamu.com)');
        $site->setConfig(json_encode('[
            "name": "Gorkamu",
            "description": "Description for Gorkamu (gorkamu.com)",
            "host": "gorkamu.com",
        ]'));

        return $site;
    }
}