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

use Phalcon\Queue\Beanstalk;
use Vain\Core\Connection\AbstractConnection;

/**
 * Class BeanstalkConnection
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BeanstalkConnection extends AbstractConnection
{
    /**
     * @inheritDoc
     */
    public function doEstablish()
    {
        $config = $this->getConfigData();
        $connection = new Beanstalk($config);
        if (isset($config['tube'])) {
            $connection->choose($config['tube']);
            $connection->watch($config['tube']);
        }
        return $connection;
    }
}