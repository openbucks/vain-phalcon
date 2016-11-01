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
declare(strict_types = 1);

namespace Vain\Phalcon\Queue\Beanstalk;

use Phalcon\Queue\Beanstalk as PhalconBeanstalkQueue;
use Vain\Queue\AbstractQueue;
use Vain\Queue\Message\QueueMessageInterface;
use Vain\Queue\QueueInterface;

/**
 * Class BeanstalkQueue
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconBeanstalkQueue  getQueue
 */
class BeanstalkQueue extends AbstractQueue
{
    /**
     * @inheritDoc
     */
    public function doSubscribe(array $configData)
    {
        return $this->getConnection()->establish();
    }

    /**
     * @inheritDoc
     */
    public function unSubscribe() : QueueInterface
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function enqueue(QueueMessageInterface $queueMessage) : QueueInterface
    {
        $this->getQueue()->put($queueMessage->toArray());

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dequeue() : QueueMessageInterface
    {
        trigger_error('Method dequeue is not implemented', E_USER_ERROR);
    }
}