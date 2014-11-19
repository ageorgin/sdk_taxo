<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 09:43
 */

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