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
    public function setSEO($title, $description = '', $canonical = '',$keywords = '',$og_url = '')
    {
        SEOTools::setTitle($title);

        if (!empty($description)) {
            $plainText = strip_tags($description);
            $plainText = html_entity_decode($plainText);
            $summaryText = mb_substr($plainText, 0, 160);
            $summaryText = preg_replace('/\s+/', ' ', $summaryText);
            $summaryText = trim($summaryText);
            SEOTools::setDescription($summaryText);
        }

        if (!empty($canonical)) {
            SEOTools::setCanonical($canonical);
        }

        if (!empty($keywords)) {
            SEOMeta::addKeyword($keywords);
        }
        if (!empty($og_url)) {
            OpenGraph::setUrl($og_url);
        }
        
    }
}
