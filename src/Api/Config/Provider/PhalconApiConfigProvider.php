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
use Vain\Phalcon\Exception\NoModuleConfigDataException;
use Vain\Phalcon\Exception\NoRouteConfigDataException;

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
     * @param ConfigProviderInterface $configProvider
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
        $moduleName = $this->router->getModuleName();
        $routeName = $this->router->getMatchedRoute()->getName();
        $config = $this->configProvider->getConfig('api');
        if (false === $config->offsetExists($moduleName)) {
            throw new NoModuleConfigDataException($this, $request, $moduleName);
        }
        $moduleData = $config->offsetGet($moduleName);
        if (false === array_key_exists($routeName, $moduleData)) {
            throw new NoRouteConfigDataException($this, $request, $routeName);
        }

        return $this->configFactory->createConfig($moduleName, $routeName, $moduleData[$routeName]);
    }

    /**
     * @inheritDoc
     */
    public function getConfigs() : array
    {
        $apiRouteConfigs = [];
        foreach ($this->configProvider->getConfig('api') as $moduleName => $routes) {
            foreach ($routes as $routeName => $routeDescription) {
                $apiRouteConfigs[] = $this->configFactory->createConfig($moduleName, $routeName, $routeDescription);
            }
        }

        return $apiRouteConfigs;
    }
}