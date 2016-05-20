<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 9:51 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\Router;

use Vain\Config\ConfigInterface;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;
use \Phalcon\Mvc\Router as PhalconMvcRouter;

class RouterBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    private $config;

    /**
     * RouterBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param ConfigInterface $config
     */
    public function __construct(BootstrapperInterface $bootstrapper, ConfigInterface $config)
    {
        $this->config = $config;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        /**
         * @var PhalconMvcRouter $router
         */
        $router = $application->getDI()->get('router');

        foreach ($this->config->offsetGet('routes') as $routeName => $routeSettings) {
            $router->add($routeName, $routeSettings);
        }

        if (false === $this->config->offsetExists('default')) {
            return $this;
        }

        $router->setDefaults($this->config->offsetGet('default'));

        return parent::bootstrap($application);
    }
}