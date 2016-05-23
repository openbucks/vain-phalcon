<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:11 AM
 */

namespace Vain\Phalcon\Bootstrapper\Factory;

use Phalcon\Filter;
use Vain\Config\Provider\ConfigProviderInterface;
use Vain\Event\Dispatcher\EventDispatcherInterface;
use Vain\Http\Request\Factory\RequestFactoryInterface;
use Vain\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\Request\RequestBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Response\ResponseBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Router\RouterBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\View\ViewBootstrapperDecorator;
use \Phalcon\Mvc\View as PhalconMvcView;

class MvcBootstrapperFactory implements BootstrapperFactoryInterface
{

    private $requestFactory;

    private $responseFactory;

    private $view;

    private $eventDispatcher;

    private $configProvider;

    /**
     * MvcBootstrapperFactory constructor.
     * @param RequestFactoryInterface $requestFactory
     * @param ResponseFactoryInterface $responseFactory
     * @param PhalconMvcView $view
     * @param EventDispatcherInterface $eventDispatcher
     * @param ConfigProviderInterface $configProvider
     */
    public function __construct(
        RequestFactoryInterface $requestFactory,
        ResponseFactoryInterface $responseFactory,
        PhalconMvcView $view,
        EventDispatcherInterface $eventDispatcher,
        ConfigProviderInterface $configProvider)

    {
        $this->requestFactory = $requestFactory;
        $this->responseFactory = $responseFactory;
        $this->view = $view;
        $this->eventDispatcher = $eventDispatcher;
        $this->configProvider = $configProvider;
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
        return new ViewBootstrapperDecorator($bootstrapper, $this->view, '../www/views/');
    }

    /**
     * @inheritDoc
     */
    public function createBootstrapper()
    {
        return $this->createRequestDecorator(
            $this->createResponseDecorator(
                $this->createViewDecorator(
                    new RouterBootstrapperDecorator(new Bootstrapper(), $this->configProvider->getConfig('router'))
                )
            )
        );
    }
}