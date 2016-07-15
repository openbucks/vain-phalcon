<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-operation
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-operation
 */
namespace Vain\Phalcon\Application\Mvc;

use Phalcon\Mvc\Application as PhalconMvcApplication;
use Psr\Http\Message\ServerRequestInterface as HttpServerRequestInterface;
use Vain\Http\Application\HttpApplicationInterface;
use Vain\Http\Request\Proxy\HttpRequestProxyInterface;
use Vain\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Http\Response\Proxy\HttpResponseProxyInterface;
use Phalcon\DiInterface as PhalconDiInterface;
use Vain\Phalcon\Application\PhalconApplicationInterface;

/**
 * Class PhalconApplication
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MvcApplication extends PhalconMvcApplication implements HttpApplicationInterface, PhalconApplicationInterface
{
    private $requestProxy;

    private $responseProxy;

    private $responseFactory;

    /**
     * PhalconApplication constructor.
     *
     * @param HttpRequestProxyInterface $requestProxy
     * @param HttpResponseProxyInterface $responseProxy
     * @param ResponseFactoryInterface $responseFactory
     * @param PhalconDiInterface $di
     */
    public function __construct(
        HttpRequestProxyInterface $requestProxy,
        HttpResponseProxyInterface $responseProxy,
        ResponseFactoryInterface $responseFactory,
        PhalconDiInterface $di
    ) {
        $this->requestProxy = $requestProxy;
        $this->responseProxy = $responseProxy;
        $this->responseFactory = $responseFactory;
        parent::__construct($di);
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(HttpServerRequestInterface $request)
    {
        $this->requestProxy->addRequest($request);
        $this->responseProxy->addResponse($this->responseFactory->createResponse('php://temp'));
        $this->handle();
        $this->requestProxy->popRequest();

        return $this->responseProxy->popResponse();
    }

    /**
     * @inheritDoc
     */
    public function handle($uri = null)
    {
        try {
            parent::handle($uri);
        } catch (\Exception $e) {
            $this->responseProxy->popResponse();
            $this->responseProxy->addResponse(
                $this->responseFactory
                    ->createResponse('php://temp', $e->getCode(), [], $e->getMessage())
                    ->withStatus($e->getCode(), $e->getMessage())
            );
        }
    }

    /**
     * @return HttpRequestProxyInterface
     */
    public function getRequestProxy()
    {
        return $this->requestProxy;
    }

    /**
     * @return HttpResponseProxyInterface
     */
    public function getResponseProxy()
    {
        return $this->responseProxy;
    }

    /**
     * @return ResponseFactoryInterface
     */
    public function getResponseFactory()
    {
        return $this->responseFactory;
    }
}