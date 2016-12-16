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
use Vain\Core\Connection\Factory\AbstractConnectionFactory;
use Vain\Phalcon\Queue\Beanstalk\BeanstalkConnection;

/**
 * Class BeanstalkConnectionFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BeanstalkConnectionFactory extends AbstractConnectionFactory
{
    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return 'beanstalk';
    }

    /**
     * @inheritDoc
     */
    public function createConnection(string $connectionName) : ConnectionInterface
    {
        return new BeanstalkConnection($this->getConfigData($connectionName));
    }
}
