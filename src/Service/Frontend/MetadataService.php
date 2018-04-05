<?php

namespace App\Service\Frontend;


class MetadataService
{
    /**
     * @param $data
     */
    public function getMetadata($data)
    {
        $data = json_decode($data, true);
        foreach($data as $key => $item) {
            if(is_array($data[$key])){
                $this->getObjectMetaTag($key, $item);
            }else{
                $this->getSingleMetaTag($key, $item);
            }
        }
    }

    /**
     * @param $data
     */
    public function getJsonLd($data)
    {
        $this->getLdJsonMetaTags($data, true);
    }

    /**
     * @param $key
     * @param $item
     */
    private function getObjectMetaTag($key, $item)
    {
        if($key == 'ldjson') {
            $this->getLdJsonMetaTags($item);
        }

        if($key == 'og') {
            $this->getOpenGraphMetaTags($item);
        }
    }

    /**
     * @param $key
     * @param $item
     */
    private function getSingleMetaTag($key, $item)
    {
        switch($key) {
            case 'title':
                echo '<title>' . $item . '</title>';
                break;

            case 'description':
            case 'keywords':
            case 'viewport':
                echo '<meta name="' . $key . '" content="' . $item . '">';
                break;

            case 'encoding':
                echo '<meta charset="' . $item . '">';
                break;
        }
    }

    /**
     * @param $item
     */
    private function getLdJsonMetaTags($item, $isEncoded = false)
    {
        echo '<script type="application/ld+json">' . ( $isEncoded ? $item : json_encode($item) ) . '</script>';
    }

    /**
     * @param $data
     * @return mixed
     * @internal param $limit
     */
    private function getOpenGraphMetaTags(array $data)
    {
        foreach($data as $key => $item) {
            echo '<meta property="og:' . $key. '" content="' . $item . '">';
        }
    }
}