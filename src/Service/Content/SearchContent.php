<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 11:44
 */

namespace Ftven\SdkTaxonomy\Service\Content;

class SearchContent extends AbstractContent implements SearchContentInterface
{
    public function execute(array $tags, $synonyms = false, $children = false, $page = 1, $limit = 100)
    {
        $response = $this->getGuzzleSvc()->get(
            self::URI . '/',
            $this->getAccessTokenSvc()->getHeaders(),
            $this->getSerialiserSvc()->serializeSearch($tags, $synonyms, $children, $page, $limit)
        );

        return $this->getMapperSvc()->getContents($response);
    }

} 