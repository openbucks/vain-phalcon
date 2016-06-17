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
namespace Vain\Phalcon\Bootstrapper\Factory;

use Vain\Config\Provider\ConfigProviderInterface;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\Decorator\Router\RouterBootstrapperDecorator;

/**
 * Class MvcBootstrapperFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MvcBootstrapperFactory implements BootstrapperFactoryInterface
{
    private $configProvider;

    /**
     * MvcBootstrapperFactory constructor.
     * @param ConfigProviderInterface $configProvider
     */
    public function __construct(ConfigProviderInterface $configProvider)
    {
        $this->configProvider = $configProvider;
    }

    /**
     * @inheritDoc
     */
    public function createBootstrapper()
    {
        return new RouterBootstrapperDecorator(new Bootstrapper(), $this->configProvider->getConfig('router'));
    }
}