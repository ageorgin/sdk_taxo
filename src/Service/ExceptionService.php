<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 20/11/14
 * Time: 16:01
 */

namespace Ftven\SdkTaxonomy\Service;

use Ftven\SdkTaxonomy\Exception\ApiException;

class ExceptionService implements ExceptionServiceInterface
{
    /**
     * @param \Exception $e
     * @return ApiException
     */
    public function getApiException(\Exception $e)
    {
        $code = $e->getCode();
        $message = $e->getMessage();

        $response = method_exists($e, 'getResponse') ? $e->getResponse() : null;
        if (!empty($response)) {
            $body = $response->getBody();
            if (!empty($body)) {
                $body = json_decode($body);
                $code = isset($body->error->code) ? $body->error->code : $e->getCode();
                $message = isset($body->error->message) ? $body->error->message : $e->getMessage();
            }
        }

        return new ApiException($message, $code);
    }
}
