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
namespace Vain\Phalcon\Bootstrapper\Decorator\Router;

use Vain\Config\ConfigInterface;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use \Phalcon\Mvc\Router as PhalconMvcRouter;
use Phalcon\Application as PhalconApplication;

/**
 * Class RouterBootstrapperDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
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
    public function bootstrap(PhalconApplication $application)
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