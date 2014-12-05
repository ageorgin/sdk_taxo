<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:15
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Entity\Content;

class CreateContent extends AbstractContent implements CreateContentInterface
{
    public function execute(Content $content)
    {
        $response = $this->getGuzzleSvc()->post(
            self::URI,
            $this->getSerialiserSvc()->serialize($content),
            array_merge(
                ['Content-Type' => 'application/json'],
                $this->getAccessTokenSvc()->getHeaders()
            )
        );

        $response = $response->json();
        $this->getMapperSvc()->populateContent($content, $response);
    }
}
