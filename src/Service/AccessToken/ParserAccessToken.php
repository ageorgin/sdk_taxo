<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 17:34
 */

namespace Ftven\SdkTaxonomy\Service\AccessToken;

use Ftven\SdkTaxonomy\Exception\SdkException;

class ParserAccessToken implements ParserAccessTokenInterface
{
    /**
     * @param $xFtvenId
     * @return array
     * @throws \Exception
     */
    public function parseXFtvenId($xFtvenId)
    {
        if (preg_match('/^id: (.*), expire: (.*), token: (.*)/', $xFtvenId, $matches)) {
            return [
                'id' => $matches[1],
                'expire' => $matches[2],
                'token' => $matches[3]
            ];
        } else {
            throw new SdkException('unable to parse X-FTVEN-ID header with value [' . $xFtvenId . ']');
        }
    }

} 