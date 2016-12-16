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
use Vain\Core\Connection\ConnectionInterface;

/**
 * Class BeanstalkConnection
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BeanstalkConnection implements ConnectionInterface
{

    private $configData;

    /**
     * BeanstalkConnection constructor.
     *
     * @param array $configData
     */
    public function __construct(array $configData)
    {
        $this->configData = $configData;
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return $this->configData['type'];
    }

    /**
     * @inheritDoc
     */
    public function establish()
    {
        return new Beanstalk($this->configData);
    }
}
