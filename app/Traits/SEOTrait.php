<?php

namespace App\Traits;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;


trait SEOTrait
{
    /**
     * Cấu hình SEO cho trang.
     *
     * @param string $title
     * @param string $description
     * @param string $keywords
     */
    public function setSEO($title, $description = '', $canonical = '',$keywords = '')
    {
        SEOTools::setTitle($title);

        if (!empty($description)) {
            SEOTools::setDescription($description);
        }
        if (!empty($description)) {
            SEOTools::setCanonical($canonical);
        }
        if (!empty($keywords)) {
            SEOMeta::addKeyword($keywords);
        }
    }
}
