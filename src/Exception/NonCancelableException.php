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
declare(strict_types = 1);

namespace Vain\Phalcon\Exception;

use Vain\Event\Exception\EventException;
use Vain\Phalcon\Event\PhalconEvent;

/**
 * Class NonCancelableException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NonCancelableException extends EventException
{
    /**
     * NonCancelableException constructor.
     *
     * @param PhalconEvent $event
     */
    public function __construct(PhalconEvent $event)
    {
        parent::__construct($event, 'Trying to stop event propagation on non-cancelable event');
    }
}
