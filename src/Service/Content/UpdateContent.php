<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 09:43
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Entity\Content;

class UpdateContent extends AbstractContent implements UpdateContentInterface
{
    public function execute(Content $content)
    {
        $response = $this->getGuzzleSvc()->put(
            self::URI . '/' . $content->getId(),
            $this->getSerialiserSvc()->serialize($content),
            array_merge(
                ['Content-Type' => 'application/json'],
                $this->getAccessTokenSvc()->getHeaders()
            )
        );

        $this->getMapperSvc()->populateContent($content, $response->json());
    }
}
