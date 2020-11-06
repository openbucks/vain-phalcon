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
        $this->getQueue(true)->put(@serialize($queueMessage->toArray()));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function doDequeue(array $configData) : ?QueueMessageInterface
    {
        $sleep = isset($configData['sleep']) ? $configData['sleep'] : 500000;
        $timeout = isset($configData['timeout']) ? $configData['timeout'] : 50;

        while (true) {
            if ($job = $timeout > 0 ? $this->getQueue(true)->reserveWithTimeout($timeout) : $this->getQueue(true)->reserve()) {
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
        $this->getQueue(true)->delete($this->jobs[$messageId]);
        unset($this->jobs[$messageId]);

        return true;
    }
}