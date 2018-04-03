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
                if($key == 'ldjson') {
                    $this->getLdJsonMetaTags($item);
                }

                if($key == 'og') {
                    $this->getOpenGraphMetaTags($item);
                }

            }else{
                switch($key) {
                    case 'title':
                        echo '<title>' . $item . '</title>';
                        break;

                    case 'description':
                        echo '<meta name="' . $key . '" content="' . $item . '">';
                        break;
                }
            }
        }
    }

    /**
     * @param $item
     */
    public function getLdJsonMetaTags($item)
    {
        echo '<script type="application/ld+json">' . json_encode($item) . '</script>';
    }

    /**
     * @param $data
     * @return mixed
     * @internal param $limit
     */
    public function getOpenGraphMetaTags(array $data)
    {
        foreach($data as $key => $item) {
            echo '<meta property="og:' . $key. '" content="' . $item . '">';
        }
    }
}