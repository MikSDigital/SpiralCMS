<?php

namespace App\Library\Extension;

use App\Service\Frontend\MetadataService;
use Twig_Function;

class TwigExtension extends \Twig_Extension
{
    /** @var MetadataService $metadataService */
    private $metadataService;

    /**
     * TwigExtension constructor.
     * @param $metadataService
     */
    public function __construct(MetadataService $metadataService)
    {
        $this->metadataService = $metadataService;
    }


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
     * @param $data
     * @internal param $name
     */
    public function getMetadata($data)
    {
        $this->metadataService->getMetadata($data);
    }
}