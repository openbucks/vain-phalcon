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

use Vain\Connection\ConnectionInterface;
use Vain\Connection\Factory\AbstractConnectionFactory;
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
    public function createConnection(array $config) : ConnectionInterface
    {
        return new BeanstalkConnection($config);
    }
}
