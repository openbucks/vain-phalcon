<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/19/16
 * Time: 9:21 AM
 */

namespace Vain\Phalcon\Application;

use \Phalcon\DiInterface as PhalconDiInterface;
use Phalcon\Mvc\Application as PhalconMvcApplication;
use Psr\Http\Message\ServerRequestInterface as HttpServerRequestInterface;
use Vain\Http\Application\HttpApplicationInterface;
use Vain\Http\Request\Proxy\HttpRequestProxyInterface;
use Vain\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Http\Response\Proxy\HttpResponseProxyInterface;

class PhalconApplication extends PhalconMvcApplication implements HttpApplicationInterface
{
    private $requestProxy;

    private $responseProxy;

    private $responseFactory;

    /**
     * PhalconApplication constructor.
     * @param HttpRequestProxyInterface $requestProxy
     * @param ResponseFactoryInterface $responseFactory
     * @param PhalconDiInterface $dependencyInjector
     */
    public function __construct(HttpRequestProxyInterface $requestProxy, HttpResponseProxyInterface $responseProxy, ResponseFactoryInterface $responseFactory, PhalconDiInterface $dependencyInjector)
    {
        $this->requestProxy = $requestProxy;
        $this->responseProxy = $responseProxy;
        $this->responseFactory = $responseFactory;
        parent::__construct($dependencyInjector);
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(HttpServerRequestInterface $request)
    {
        $this->requestProxy->addRequest($request);
        try {
            $response = $this->handle();
        } catch (\Exception $e) {
            $response = $this->responseFactory
                ->createResponse('php://temp')
                ->withStatus($e->getCode(), $e->getMessage());
        }

        $this->requestProxy->popRequest();
        $this->responseProxy->popResponse();

        return $response;
    }
}