<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:11 AM
 */

namespace Vain\Phalcon\Bootstrapper\Factory;

use Vain\Config\Provider\ConfigProviderInterface;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\Decorator\Router\RouterBootstrapperDecorator;

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