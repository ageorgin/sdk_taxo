<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 17:34
 */

class ParserAccessToken implements ParserAccessTokenInterface
{
    /**
     * @param $xFtvenId
     * @return array
     * @throws Exception
     */
    public function parseXFtvenId($xFtvenId)
    {
        if (preg_match('/^id: (.*), expire: (.*), token: (.*)/', $xFtvenId, $matches)) {
            var_dump($matches);

            return [
                'id' => $matches[1],
                'expire' => $matches[2],
                'token' => $matches[3]
            ];
        } else {
            throw new \Exception('unable to parse X-FTVEN-ID header');
        }
    }

} 