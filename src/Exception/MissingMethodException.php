<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
namespace Vain\Phalcon\Exception;

use Vain\Event\Exception\ListenerException;
use Vain\Event\Listener\ListenerInterface;

/**
 * Class MissingMethodException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MissingMethodException extends ListenerException
{
    /**
     * MissingMethodException constructor.
     *
     * @param ListenerInterface $listener
     * @param string            $method
     */
    public function __construct(ListenerInterface $listener, $method)
    {
        parent::__construct(
            $listener,
            sprintf('Handler %s does not have method %s', get_class($listener), $method),
            0,
            null
        );
    }
}