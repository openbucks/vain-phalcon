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

use Vain\Core\Exception\AbstractCoreException;
use Vain\Event\Dispatcher\EventDispatcherInterface;

/**
 * Class DispatcherException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DispatcherException extends AbstractCoreException
{
    private $dispatcher;

    /**
     * DispatcherException constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     * @param string                   $message
     * @param int                      $code
     * @param \Exception|null          $previous
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