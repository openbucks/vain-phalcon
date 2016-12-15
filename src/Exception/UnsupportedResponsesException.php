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

use Vain\Core\Event\Dispatcher\EventDispatcherInterface;

/**
 * Class UnsupportedResponsesException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedResponsesException extends DispatcherException
{
    /**
     * UnsupportedResponsesException constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher, 'Response collecting is not supported in Phalcon bridge');
    }
}
