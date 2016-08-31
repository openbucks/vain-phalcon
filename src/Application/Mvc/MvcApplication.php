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
use Vain\Phalcon\Application\Module\PhalconApplicationModuleInterface;
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

    private $modules;

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
    public function addModule($alias, PhalconApplicationModuleInterface $applicationModule)
    {
        $this->modules[$alias] = $applicationModule;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getApplicationModules()
    {
        return $this->modules;
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(HttpServerRequestInterface $request)
    {
        $this->requestProxy->addRequest($request);
        $this->responseProxy->addResponse($this->responseFactory->createResponse('php://temp'));
        try {
            $this->handle($request->getUri()->getPath());
        } catch (\Exception $e) {
            $this->responseProxy->popResponse();
            $this->responseProxy->addResponse(
                $this->responseFactory
                    ->createResponse('php://temp', $e->getCode(), [], $e->getMessage())
                    ->withStatus($e->getCode(), $e->getMessage())
            );
        }
        $this->requestProxy->popRequest();

        return $this->responseProxy->popResponse();
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