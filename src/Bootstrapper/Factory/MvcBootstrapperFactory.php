<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:11 AM
 */

namespace Vain\Phalcon\Bootstrapper\Factory;

use Phalcon\Filter;
use Vain\Http\Request\Factory\RequestFactoryInterface;
use Vain\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\Application\ApplicationBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Request\RequestBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Response\ResponseBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Router\RouterBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Url\UrlBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\View\ViewBootstrapperDecorator;

class MvcBootstrapperFactory implements BootstrapperFactoryInterface
{

    private $requestFactory;

    private $responseFactory;

    /**
     * MvcBootstrapperFactory constructor.
     * @param RequestFactoryInterface $requestFactory
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(RequestFactoryInterface $requestFactory, ResponseFactoryInterface $responseFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param BootstrapperInterface $bootstrapper
     *
     * @return RequestBootstrapperDecorator
     */
    protected function createRequestDecorator(BootstrapperInterface $bootstrapper)
    {
        return new RequestBootstrapperDecorator($bootstrapper, $this->requestFactory);
    }

    /**
     * @param BootstrapperInterface $bootstrapper
     *
     * @return RequestBootstrapperDecorator
     */
    protected function createResponseDecorator(BootstrapperInterface $bootstrapper)
    {
        return new ResponseBootstrapperDecorator($bootstrapper, $this->responseFactory);
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

    protected function createApplicationDecorator(BootstrapperInterface $bootstrapper)
    {
        return new ApplicationBootstrapperDecorator($bootstrapper, $this->responseFactory);
    }

    /**
     * @inheritDoc
     */
    public function createBootstrapper()
    {
        return $this->createApplicationDecorator(
            $this->createRequestDecorator(
                $this->createResponseDecorator(
                    $this->createViewDecorator(
                        new UrlBootstrapperDecorator(
                            new RouterBootstrapperDecorator(new Bootstrapper())
                        )
                    )
                )
            )
        );
    }
}