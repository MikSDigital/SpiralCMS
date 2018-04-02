<?php

namespace App\Library\Extension;

use Twig_Function;

class TwigExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new Twig_Function('get_metadata', [$this, 'getMetadata']),
        );
    }

    public function getMetadata($name)
    {
        echo sprintf('<script type="application/ld+json">%s</script>', $name);
    }
}