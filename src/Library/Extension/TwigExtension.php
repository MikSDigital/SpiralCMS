<?php

namespace App\Library\Extension;

use Twig_Function;

class TwigExtension extends \Twig_Extension
{
    /**
     * @return array|Twig_Function[]
     */
    public function getFunctions()
    {
        return array(
            new Twig_Function('get_metadata', [$this, 'getMetadata']),
        );
    }

    /**
     * @param $name
     */
    public function getMetadata($data)
    {
        $metadata = json_decode($data);

        if($metadata->title) echo '<title>' . $metadata->title . '</title>';
        if($metadata->description) echo '<meta name="description" content="' . $metadata->description . '">';
        if($metadata->ldjson) {
            echo '<script type="application/ld+json">' . json_encode($metadata->ldjson) . '</script>';
        }

        if($metadata->og) {
            if($metadata->og->site_name) echo '<meta property="og:site_name" content="' . $metadata->og->site_name . '">';
            if($metadata->og->title) echo '<meta property="og:title" content="' . $metadata->og->title . '">';
            if($metadata->og->url) echo '<meta property="og:url" content="' . $metadata->og->url . '">';
            if($metadata->og->type) echo '<meta property="og:type" content="' . $metadata->og->type . '">';
            if($metadata->og->description) echo '<meta property="og:description" content="' . $metadata->og->description . '">';
            if($metadata->og->image) echo '<meta property="og:image" content="' . $metadata->og->image . '">';
        }
    }
}