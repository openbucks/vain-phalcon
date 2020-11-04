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

use Vain\Core\Queue\AbstractQueue;
use Vain\Core\Queue\Message\QueueMessageInterface;
use Vain\Core\Queue\QueueInterface;

/**
 * Class BeanstalkQueue
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method Pheanstalk\Pheanstalk  getQueue
 */
class BeanstalkQueue extends AbstractQueue
{
    /**
     * @var Pheanstalk\Job[]
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
        $this->getQueue()->put(@serialize($queueMessage->toArray()));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function doDequeue(array $configData) : ?QueueMessageInterface
    {
        $sleep = isset($configData['sleep']) ? $configData['sleep'] : 500000;
        while (true) {
            while ($this->getQueue()->peekReady() !== false) {
                if (false === ($job = $this->getQueue()->reserve())) {
                    return null;
                }
                $serializedMessage = @unserialize($job->getData());
                $message = $this->getFactoryStorage()->getFactory($serializedMessage['type'])->createFromArray(
                    $serializedMessage
                );

                $this->jobs[$message->getId()] = $job;

                return $message;
            }
            usleep($sleep);
        }
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
        $this->getQueue()->delete($this->jobs[$messageId]);
        unset($this->jobs[$messageId]);

        return true;
    }
}