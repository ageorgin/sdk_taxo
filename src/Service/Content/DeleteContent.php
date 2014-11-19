<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 11:10
 */

class DeleteContent extends AbstractContent implements DeleteContentInterface
{
    public function execute(Content $content)
    {
        $this->getGuzzleSvc()->delete(
            self::URI . '/' . $content->getId(),
            $this->getAccessTokenSvc()->getHeaders()
        );
    }

} 