<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/18/16
 * Time: 11:39 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\Response;

use Vain\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;
use Vain\Phalcon\Http\Response\Proxy\PhalconResponseProxyInterface;

class ResponseBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    private $responseProxy;

    private $responseFactory;

    /**
     * ResponseBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param PhalconResponseProxyInterface $responseProxy
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(BootstrapperInterface $bootstrapper, PhalconResponseProxyInterface $responseProxy, ResponseFactoryInterface $responseFactory)
    {
        $this->responseProxy = $responseProxy;
        $this->responseFactory = $responseFactory;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        $this->responseProxy->addResponse($this->responseFactory->createResponse('php://temp'));

        return parent::bootstrap($application);
    }
}