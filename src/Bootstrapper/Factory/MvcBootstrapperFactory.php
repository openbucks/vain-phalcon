<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:11 AM
 */

namespace Vain\Phalcon\Bootstrapper\Factory;

use Phalcon\Filter;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\Decorator\Request\RequestBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Router\RouterBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Url\UrlBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\View\ViewBootstrapperDecorator;
use Vain\Phalcon\Http\Factory\PhalconHttpFactory;
use Vain\Phalcon\Http\Header\Factory\PhalconHeaderFactory;

class MvcBootstrapperFactory implements BootstrapperFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createBootstrapper()
    {
        return new RequestBootstrapperDecorator(new PhalconHttpFactory(new Filter(), new PhalconHeaderFactory()), new UrlBootstrapperDecorator(new RouterBootstrapperDecorator(new ViewBootstrapperDecorator(new Bootstrapper(), '../www/views/'))));
    }
}