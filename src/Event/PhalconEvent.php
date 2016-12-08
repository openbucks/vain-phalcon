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
namespace Vain\Phalcon\Event;

use Vain\Event\AbstractEvent;
use Vain\Event\EventInterface;
use Vain\Phalcon\Exception\NonCancelableException;

/**
 * Class PhalconEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconEvent extends AbstractEvent implements EventInterface
{
    private $source;

    private $data;

    private $stopped;

    private $cancelable;

    /**
     * PhalconEvent constructor.
     *
     * @param string $name
     * @param mixed  $source
     * @param mixed  $data
     * @param bool   $cancelable
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
     * @inheritDoc
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @inheritDoc
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isStopped()
    {
        return $this->stopped;
    }

    /**
     * @inheritDoc
     */
    public function setStopped($stopped)
    {
        $this->stopped = $stopped;

        return $this;
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
     * @inheritDoc
     */
    public function setCancelable($cancelable)
    {
        $this->cancelable = $cancelable;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function stop()
    {
        if (false === $this->cancelable) {
            throw new NonCancelableException($this);
        }
        $this->stopped = true;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray() : array
    {
        return array_merge(
            [
                'source' => $this->source,
                'data' => $this->data,
                'cancelable' => $this->cancelable,
                'stopper' => $this->stopped,
            ],
            parent::toArray()
        );
    }

    /**
     * @inheritDoc
     */
    public function fromArray(array $data) : EventInterface
    {
        $this->source = $data['source'];
        $this->data = $data['data'];
        $this->cancelable = $data['cancelable'];
        $this->stopped = $data['stopped'];

        return parent::fromArray($data);
    }
}
