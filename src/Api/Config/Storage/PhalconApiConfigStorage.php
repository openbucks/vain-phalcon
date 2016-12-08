<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-phalcon
 */
namespace Vain\Phalcon\Api\Config\Storage;

use Vain\Api\Config\ApiConfigInterface;
use Phalcon\Mvc\RouterInterface as PhalconMvcRouterInterface;
use Vain\Api\Config\Storage\ApiConfigStorageInterface;
use Vain\Api\Exception\UnknownRouteException;

/**
 * Class PhalconApiConfigStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApiConfigStorage implements ApiConfigStorageInterface
{
    private $apiConfigStorage;

    private $router;

    /**
     * PhalconApiConfigProvider constructor.
     *
     * @param ApiConfigStorageInterface $apiConfigStorage
     * @param PhalconMvcRouterInterface $router
     */
    public function __construct(
        ApiConfigStorageInterface $apiConfigStorage,
        PhalconMvcRouterInterface $router
    ) {
        $this->apiConfigStorage = $apiConfigStorage;
        $this->router = $router;
    }

    /**
     * @inheritDoc
     */
    public function getConfig(string $endpointName) : ApiConfigInterface
    {
        if (false === $this->router->wasMatched()) {
            throw new UnknownRouteException($this, $endpointName);
        }

        return $this->apiConfigStorage->getConfig($this->router->getMatchedRoute()->getName());
    }

    /**
     * @inheritDoc
     */
    public function getConfigs() : array
    {
        return $this->apiConfigStorage->getConfigs();
    }
}
