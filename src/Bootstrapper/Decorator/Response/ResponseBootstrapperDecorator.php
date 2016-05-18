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
use Phalcon\DiInterface as PhalconDiInterface;

class ResponseBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    private $responseFactory;

    /**
     * ResponseBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(BootstrapperInterface $bootstrapper, ResponseFactoryInterface $responseFactory)
    {
        parent::__construct($bootstrapper);
        $this->responseFactory = $responseFactory;
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application, PhalconDiInterface $di)
    {
        $response = $this->responseFactory->createResponse('php://temp');
        $di->setShared('response', $response);

        return parent::bootstrap($application, $di);
    }
}