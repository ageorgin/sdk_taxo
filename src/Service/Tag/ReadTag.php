<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 26/11/14
 * Time: 11:17
 */

namespace Ftven\SdkTaxonomy\Service\Tag;


use Ftven\SdkTaxonomy\Entity\Tag;

class ReadTag extends AbstractTag implements ReadTagInterface
{
    public function execute($id)
    {
        $response = $this->getGuzzleSvc()->get(
            self::URI . '/' . $id,
            $this->getAccessTokenSvc()->getHeaders()
        );

        $ret = new Tag();
        $this->getMapperSvc()->populateTag($ret, $response);
        return $ret;
    }

} 