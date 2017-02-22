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
use Vain\Core\Http\Application\HttpApplicationInterface;
use Vain\Core\Http\Request\VainServerRequestInterface;
use Vain\Core\Http\Response\Proxy\HttpResponseProxyInterface;
use Vain\Core\Http\Response\VainResponseInterface;

/**
 * Class PhalconApplication
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApplication implements HttpApplicationInterface
{
    private $application;

    private $responseProxy;

    /**
     * PhalconApplication constructor.
     *
     * @param PhalconMvcApplication      $application
     * @param HttpResponseProxyInterface $responseProxy
     */
    public function __construct(PhalconMvcApplication $application, HttpResponseProxyInterface $responseProxy)
    {
        $this->application = $application;
        $this->responseProxy = $responseProxy;
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(VainServerRequestInterface $request): VainResponseInterface
    {
        $this->application->handle($request->getUri()->getPath());

        return $this->responseProxy->getCurrentResponse();
    }

    /**
     * @inheritDoc
     */
    public function getContainer(): ContainerInterface
    {
        return $this->application->getDI();
    }
}
