<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 9:49 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator;

use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Phalcon\Di\Injectable as PhalconDiInjectable;
use Phalcon\DiInterface as PhalconDiInterface;

abstract class AbstractBootstrapperDecorator implements BootstrapperInterface
{
    private $bootstrapper;

    /**
     * AbstractBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     */
    public function __construct(BootstrapperInterface $bootstrapper)
    {
        $this->bootstrapper = $bootstrapper;
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application, PhalconDiInterface $di)
    {
        return $this->bootstrapper->bootstrap($application, $di);
    }

    /**
     * @return BootstrapperInterface
     */
    public function getBootstrapper()
    {
        return $this->bootstrapper;
    }
}