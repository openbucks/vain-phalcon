<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/5/16
 * Time: 10:54 AM
 */

namespace Vain\Phalcon\Event;

use Vain\Event\AbstractEvent;
use Vain\Event\EventInterface;
use Vain\Phalcon\Exception\NonCancelableException;

class PhalconEvent extends AbstractEvent implements EventInterface
{
    private $source;

    private $data;

    private $stopped;

    private $cancelable;

    /**
     * PhalconEvent constructor.
     * @param string $name
     * @param mixed $source
     * @param mixed $data
     * @param bool $cancelable
     */
    public function __construct($name, $source, $data, $cancelable = true)
    {
        $this->source = $source;
        $this->data = $data;
        $this->cancelable = $cancelable;
        $this->stopped = false;
        parent::__construct($name);
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return boolean
     */
    public function isStopped()
    {
        return $this->stopped;
    }

    /**
     * @param boolean $stopped
     */
    public function setStopped($stopped)
    {
        $this->stopped = $stopped;
    }

    /**
     * @return boolean
     */
    public function isCancelable()
    {
        return $this->getCancelable();
    }

    /**
     * @return boolean
     */
    public function getCancelable()
    {
        return $this->cancelable;

    }
    /**
     * @param boolean $cancelable
     */
    public function setCancelable($cancelable)
    {
        $this->cancelable = $cancelable;
    }

    public function stop()
    {
        if (false === $this->cancelable) {
            throw new NonCancelableException($this);
        }
        $this->stopped = true;

        return $this;
    }
}