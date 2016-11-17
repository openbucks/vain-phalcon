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
use Vain\Config\Provider\ConfigProviderInterface;
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

    private $configProvider;

    private $configFactory;

    /**
     * PhalconApiConfigProvider constructor.
     *
     * @param PhalconMvcRouterInterface $router
     * @param ConfigProviderInterface   $configProvider
     * @param ApiConfigFactoryInterface $apiConfigFactory
     */
    public function __construct(
        PhalconMvcRouterInterface $router,
        ConfigProviderInterface $configProvider,
        ApiConfigFactoryInterface $apiConfigFactory
    ) {
        $this->router = $router;
        $this->configProvider = $configProvider;
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
        $config = $this->configProvider->getConfig('api');
        if (false === $config->offsetExists($routeName)) {
            throw new NoRouteConfigDataException($this, $request, $routeName);
        }

        return $this->configFactory->createConfig($routeName, $config->offsetGet($routeName));
    }

    /**
     * @inheritDoc
     */
    public function getConfigs() : array
    {
        $apiRouteConfigs = [];
        foreach ($this->configProvider->getConfig('api') as $routeName => $routeDescription) {
            $apiRouteConfigs[] = $this->configFactory->createConfig($routeName, $routeDescription);
        }

        return $apiRouteConfigs;
    }
}