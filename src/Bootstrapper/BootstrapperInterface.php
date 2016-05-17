<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 9:48 AM
 */

namespace Vain\Phalcon\Bootstrapper;

use Phalcon\Di\Injectable as PhalconDiInjectable;
use Phalcon\DiInterface as PhalconDiInterface;

interface BootstrapperInterface
{
    /**
     * @param PhalconDiInjectable $application
     * @param PhalconDiInterface $di
     *
     * @return BootstrapperInterface
     */
    public function bootstrap(PhalconDiInjectable $application, PhalconDiInterface $di);
}