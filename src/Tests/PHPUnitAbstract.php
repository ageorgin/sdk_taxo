<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 18/07/14
 * Time: 16:42
 */

namespace Ftven\SdkTaxonomy\Tests;

require __DIR__ . '/bootstrap.php';


class PHPUnitAbstract extends \PHPUnit_Framework_TestCase
{
    protected function getResultFromMethod($classObj, $method, $params)
    {
        $reflectionClass = new \ReflectionClass(get_class($classObj));
        $method = $reflectionClass->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($classObj, $params);
    }
}
