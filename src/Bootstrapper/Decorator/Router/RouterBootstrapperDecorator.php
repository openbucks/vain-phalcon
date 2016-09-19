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
     *
     * @param BootstrapperInterface $bootstrapper
     * @param ConfigInterface       $config
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
        parent::bootstrap($application);

        /**
         * @var PhalconMvcRouter $router
         */
        $router = $application->getDI()->get('router');

        if ($this->config->offsetExists('routes')) {
            $routes = $this->config->offsetGet('routes');
            foreach ($routes as $routeName => $routeSettings) {
                $router->add($routeName, $routeSettings);
            }
        }

        if ($this->config->offsetExists('default')) {
            $router->setDefaults($this->config->offsetGet('default'));
        }
    }
}