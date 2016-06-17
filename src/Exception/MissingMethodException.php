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

use Vain\Event\Dispatcher\EventDispatcherInterface;

/**
 * Class MissingMethodException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MissingMethodException extends DispatcherException
{
    /**
     * MissingMethodException constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param object $handler
     * @param string $method
     */
    public function __construct(EventDispatcherInterface $dispatcher, $handler, $method)
    {
        parent::__construct($dispatcher, sprintf('Handler %s does not have method %s', get_class($handler), $method), 0, null);
    }
}