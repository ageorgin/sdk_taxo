<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 20/11/14
 * Time: 15:59
 */

namespace Ftven\SdkTaxonomy\Service;

use Ftven\SdkTaxonomy\Exception\ApiException;

interface ExceptionServiceInterface
{
    /**
     * @param \Exception $e
     * @return ApiException
     */
    public function getApiException(\Exception $e);
}
