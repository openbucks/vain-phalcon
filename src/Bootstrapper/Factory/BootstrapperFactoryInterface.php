<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:10 AM
 */

namespace Vain\Phalcon\Bootstrapper\Factory;

use Vain\Phalcon\Bootstrapper\BootstrapperInterface;

interface BootstrapperFactoryInterface
{
    /**
     * @return BootstrapperInterface
     */
    public function createBootstrapper();
}