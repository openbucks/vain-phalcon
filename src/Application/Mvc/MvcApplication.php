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
use Vain\Core\Container\ContainerInterface;
use Vain\Core\Event\Dispatcher\EventDispatcherInterface;
use Vain\Core\Http\Application\HttpApplicationInterface;
use Vain\Core\Http\Event\Factory\HttpEventFactoryInterface;
use Vain\Core\Http\Request\Proxy\HttpRequestProxyInterface;
use Vain\Core\Http\Request\VainServerRequestInterface;
use Vain\Core\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Core\Http\Response\Proxy\HttpResponseProxyInterface;
use Phalcon\DiInterface as PhalconDiInterface;
use Vain\Core\Http\Response\VainResponseInterface;

/**
 * Class PhalconApplication
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method ContainerInterface getDI
 */
class MvcApplication extends PhalconMvcApplication implements HttpApplicationInterface
{
    private $requestProxy;

    private $responseProxy;

    private $responseFactory;

    private $eventFactory;

    private $eventDispatcher;

    /**
     * MvcApplication constructor.
     *
     * @param HttpRequestProxyInterface  $requestProxy
     * @param HttpResponseProxyInterface $responseProxy
     * @param HttpEventFactoryInterface  $eventFactory
     * @param EventDispatcherInterface   $eventDispatcher
     * @param ResponseFactoryInterface   $responseFactory
     * @param PhalconDiInterface         $di
     */
    public function __construct(
        HttpRequestProxyInterface $requestProxy,
        HttpResponseProxyInterface $responseProxy,
        HttpEventFactoryInterface $eventFactory,
        EventDispatcherInterface $eventDispatcher,
        ResponseFactoryInterface $responseFactory,
        PhalconDiInterface $di
    ) {
        $this->requestProxy = $requestProxy;
        $this->responseProxy = $responseProxy;
        $this->eventFactory = $eventFactory;
        $this->eventDispatcher = $eventDispatcher;
        $this->responseFactory = $responseFactory;
        parent::__construct($di);
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(VainServerRequestInterface $request) : VainResponseInterface
    {
        $this->requestProxy->addRequest($request);
        $this->responseProxy->addResponse($this->responseFactory->createResponse('php://temp'));
        $this->eventDispatcher->dispatch($this->eventFactory->createRequestEvent($request));

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
        $response = $this->responseProxy->popResponse();
        $this->eventDispatcher->dispatch($this->eventFactory->createResponseEvent($response));
        $this->requestProxy->popRequest();

        return $response;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer() : ContainerInterface
    {
        return $this->getDI();
    }

    /**
     * @return HttpRequestProxyInterface
     */
    public function getRequestProxy() : HttpRequestProxyInterface
    {
        return $this->requestProxy;
    }

    /**
     * @return HttpResponseProxyInterface
     */
    public function getResponseProxy() : HttpResponseProxyInterface
    {
        return $this->responseProxy;
    }

    /**
     * @return ResponseFactoryInterface
     */
    public function getResponseFactory() : ResponseFactoryInterface
    {
        return $this->responseFactory;
    }
}
