<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/6/16
 * Time: 9:27 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Core\Exception\CoreException;
use Vain\Event\Dispatcher\EventDispatcherInterface;

class DispatcherException extends CoreException
{
    private $dispatcher;

    /**
     * DispatcherException constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(EventDispatcherInterface $dispatcher, $message, $code, \Exception $previous = null)
    {
        $this->dispatcher = $dispatcher;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }
}