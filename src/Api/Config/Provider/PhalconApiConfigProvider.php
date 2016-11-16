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
namespace Vain\Phalcon\Api\Config\Provider;

use Vain\Api\Config\ApiConfigInterface;
use Vain\Api\Config\Factory\ApiConfigFactoryInterface;
use Vain\Api\Config\Provider\ApiConfigProviderInterface;
use Phalcon\Mvc\RouterInterface as PhalconMvcRouterInterface;
use Vain\Api\Config\Storage\ApiConfigStorageInterface;
use Vain\Http\Request\VainServerRequestInterface;
use Vain\Phalcon\Exception\NoRouteConfigDataException;
use Vain\Phalcon\Exception\UnknownRouteException;

/**
 * Class PhalconApiConfigProvider
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApiConfigProvider implements ApiConfigProviderInterface, ApiConfigStorageInterface
{
    private $router;

    private $config;

    private $configFactory;

    /**
     * PhalconApiConfigProvider constructor.
     *
     * @param PhalconMvcRouterInterface $router
     * @param \ArrayAccess $config
     * @param ApiConfigFactoryInterface $apiConfigFactory
     */
    public function __construct(
        PhalconMvcRouterInterface $router,
        \ArrayAccess $config,
        ApiConfigFactoryInterface $apiConfigFactory
    )
    {
        $this->router = $router;
        $this->config = $config;
        $this->configFactory = $apiConfigFactory;
    }

    /**
     * @inheritDoc
     */
    public function getConfig(VainServerRequestInterface $request) : ApiConfigInterface
    {
        if (false === $this->router->wasMatched()) {
            throw new UnknownRouteException($this, $request);
        }

        $routeName = $this->router->getMatchedRoute()->getName();
        if (false === $this->config->offsetExists($routeName)) {
            throw new NoRouteConfigDataException($this, $request, $routeName);
        }

        return $this->configFactory->createConfig($routeName, $this->config->offsetGet($routeName));
    }

    /**
     * @inheritDoc
     */
    public function getConfigs() : array
    {
        $apiRouteConfigs = [];
        foreach ($this->config as  $routeName => $routeDescription) {
            $apiRouteConfigs[] = $this->configFactory->createConfig($routeName, $routeDescription);
        }

        return $apiRouteConfigs;
    }
}