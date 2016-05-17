<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:11 AM
 */

namespace Vain\Phalcon\Bootstrapper\Factory;

use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\Decorator\Router\RouterBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Url\UrlBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\View\ViewBootstrapperDecorator;

class MvcBootstrapperFactory implements BootstrapperFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createBootstrapper()
    {
        return new UrlBootstrapperDecorator(new RouterBootstrapperDecorator(new ViewBootstrapperDecorator(new Bootstrapper(), '../www/views/')));
    }
}