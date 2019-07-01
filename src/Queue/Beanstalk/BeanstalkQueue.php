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
use \Phalcon\Queue\Beanstalk\Job as PhalconBeanstalkJob;
use Vain\Core\Queue\AbstractQueue;
use Vain\Core\Queue\Message\QueueMessageInterface;
use Vain\Core\Queue\QueueInterface;

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
     * @var PhalconBeanstalkJob[]
     */
    private $jobs;

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
    public function doDequeue() : ?QueueMessageInterface
    {
        if (false === ($job = $this->getQueue()->reserve())) {
            return null;
        }

        $serializedMessage = $job->getBody();
        $message = $this->getFactoryStorage()->getFactory($serializedMessage['type'])->createFromArray(
            $serializedMessage
        );

        $this->jobs[$message->getId()] = $job;

        return $message;
    }

    /**
     * @inheritDoc
     */
    public function doConfirm(QueueMessageInterface $queueMessage) : bool
    {
        $messageId = $queueMessage->getId();
        if (false === array_key_exists($messageId, $this->jobs)) {
            return false;
        }

        if (false === $this->jobs[$messageId]->delete()) {
            return false;
        }
        unset($this->jobs[$messageId]);

        return true;
    }
}