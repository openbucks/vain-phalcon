<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:11 AM
 */

namespace Vain\Phalcon\Bootstrapper\Factory;

use Phalcon\Filter;
use Vain\Http\Header\Provider\Server\ServerHeaderProvider;
use Vain\Http\Response\Emitter\Sapi\SapiEmitter;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\Request\RequestBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Response\ResponseBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Router\RouterBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Url\UrlBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\View\ViewBootstrapperDecorator;
use Vain\Phalcon\Http\Factory\PhalconHttpFactory;
use Vain\Phalcon\Http\Header\Factory\PhalconHeaderFactory;

class MvcBootstrapperFactory implements BootstrapperFactoryInterface
{

    /**
     * @param BootstrapperInterface $bootstrapper
     *
     * @return RequestBootstrapperDecorator
     */
    protected function createRequestDecorator(BootstrapperInterface $bootstrapper)
    {
        return new RequestBootstrapperDecorator($bootstrapper, new PhalconHttpFactory(new Filter(), new SapiEmitter(), new ServerHeaderProvider(), new PhalconHeaderFactory()));
    }

    /**
     * @param BootstrapperInterface $bootstrapper
     *
     * @return RequestBootstrapperDecorator
     */
    protected function createResponseDecorator(BootstrapperInterface $bootstrapper)
    {
        return new ResponseBootstrapperDecorator($bootstrapper, new PhalconHttpFactory(new Filter(), new SapiEmitter(), new ServerHeaderProvider(), new PhalconHeaderFactory()));
    }

    /**
     * @param BootstrapperInterface $bootstrapper
     *
     * @return ViewBootstrapperDecorator
     */
    protected function createViewDecorator(BootstrapperInterface $bootstrapper)
    {
        return new ViewBootstrapperDecorator($bootstrapper, '../www/views/');
    }

    /**
     * @inheritDoc
     */
    public function createBootstrapper()
    {
        return $this->createRequestDecorator($this->createResponseDecorator(new UrlBootstrapperDecorator(new RouterBootstrapperDecorator($this->createViewDecorator(new Bootstrapper())))));
    }
}