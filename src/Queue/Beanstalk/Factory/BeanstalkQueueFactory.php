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

namespace Vain\Phalcon\Queue\Beanstalk\Factory;

use Vain\Core\Connection\ConnectionInterface;
use Vain\Phalcon\Queue\Beanstalk\BeanstalkQueue;
use Vain\Queue\Factory\AbstractQueueFactory;

/**
 * Class BeanstalkQueueFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BeanstalkQueueFactory extends AbstractQueueFactory
{
    /**
     * @inheritDoc
     */
    public function createQueue(array $configData, ConnectionInterface $connection)
    {
        return new BeanstalkQueue($connection, $this->getFactoryStorage(), $configData);
    }
}
