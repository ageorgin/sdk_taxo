<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 10:12
 */

namespace Ftven\SdkTaxonomy\Service\Tag;

class AutocompleteTag extends AbstractTag implements AutocompleteTagInterface
{
    const URI = '/tags/autocomplete/';

    public function execute($filter, $sort = null)
    {
        $params = [];
        if (null !== $sort) {
            $params['sort'] = $sort;
        }

        $response = $this->getGuzzleSvc()->get(self::URI . $filter, $this->getAccessTokenSvc()->getHeaders(), $params);
        return $this->getMapperSvc()->getTags($response);
    }
}
