<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:33 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\Request;

use Vain\Http\Request\Factory\RequestFactoryInterface;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;
use Vain\Phalcon\Http\Request\Proxy\PhalconRequestProxyInterface;

class RequestBootstrapperDecorator extends AbstractBootstrapperDecorator
{

    private $requestProxy;

    private $requestFactory;

    /**
     * RequestBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param PhalconRequestProxyInterface $requestProxy
     * @param RequestFactoryInterface $requestFactory
     */
    public function __construct(BootstrapperInterface $bootstrapper, PhalconRequestProxyInterface $requestProxy, RequestFactoryInterface $requestFactory)
    {
        $this->requestProxy = $requestProxy;
        $this->requestFactory = $requestFactory;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        $this->requestProxy->addRequest($this->requestFactory->createRequest($_SERVER, $_GET, [], $_POST, $_FILES, $_COOKIE, 'php://input'));

        return parent::bootstrap($application);
    }
}