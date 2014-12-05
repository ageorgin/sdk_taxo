<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 15:54
 */

namespace Ftven\SdkTaxonomy\Service\Tag;

use Ftven\SdkTaxonomy\Entity\Tag;

class CreateTag extends AbstractTag implements CreateTagInterface
{
    public function execute(Tag $tag)
    {
        $response = $this->getGuzzleSvc()->post(
            self::URI,
            $this->getSerializerSvc()->getCreateSerialization($tag),
            array_merge(
                ['Content-Type' => 'application/json'],
                $this->getAccessTokenSvc()->getHeaders()
            )
        );

        $response = $response->json();
        $this->getMapperSvc()->populateTag($tag, $response);
    }
}
