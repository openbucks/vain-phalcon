<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 11:48 AM
 */

namespace Vain\Phalcon\Di\Factory;

use \Phalcon\DiInterface as PhalconDiInterface;

interface DiFactoryInterface
{
    /**
     * @return PhalconDiInterface
     */
    public function createDi();
}