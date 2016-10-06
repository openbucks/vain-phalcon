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

use Vain\Event\EventInterface;
use Vain\Event\Resolver\ResolverInterface;

/**
 * Class PhalconResolver
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconResolver implements ResolverInterface
{
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
    public function resolveGroup(EventInterface $event) : string
    {
        list ($component, $method) = explode(':', $event->getName());

        return $component;
    }
}