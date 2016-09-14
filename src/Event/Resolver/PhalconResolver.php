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
namespace Vain\Phalcon\Event\Resolver;

use Vain\Config\ConfigInterface;
use Vain\Event\EventInterface;
use Vain\Event\Resolver\ResolverInterface;

/**
 * Class PhalconResolver
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconResolver implements ResolverInterface
{
    private $config;

    /**
     * PhalconResolver constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function resolveMethod(EventInterface $event) : string
    {
        list ($component, $method) = explode(':', $event->getName());

        return $method;
    }

    /**
     * @inheritDoc
     */
    public function resolveAlias(EventInterface $event) : string
    {
        list ($component, $method) = explode(':', $event->getName());
        if (false === $this->config->offsetExists($component)) {
            return null;
        }

        $configData = $this->config->offsetGet($component);

        if (false === array_key_exists($method, $configData)) {
            return null;
        }

        return $configData[$method];
    }
}