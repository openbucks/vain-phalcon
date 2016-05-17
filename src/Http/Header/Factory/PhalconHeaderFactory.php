<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/13/16
 * Time: 11:52 AM
 */

namespace Vain\Phalcon\Http\Header\Factory;


use Vain\Http\Header\Factory\HeaderFactoryInterface;
use Vain\Phalcon\Http\Header\PhalconHeader;

class PhalconHeaderFactory implements HeaderFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createHeader($name, $value)
    {
        $transformedValue = $value;
        if (false === is_array($value)) {
            $transformedValue = [$value];
        }

        return new PhalconHeader($name, $transformedValue);
    }
}