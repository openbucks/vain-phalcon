<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:04 AM
 */

namespace Vain\Phalcon\Bootstrapper;

use Phalcon\Di\Injectable as PhalconDiInjectable;
use Phalcon\DiInterface as PhalconDiInterface;

class Bootstrapper implements BootstrapperInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application, PhalconDiInterface $di)
    {
        $application->setDI($di);

        return $this;
    }
}