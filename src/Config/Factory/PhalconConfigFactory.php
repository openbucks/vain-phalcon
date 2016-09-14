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
namespace Vain\Phalcon\Config\Factory;

use Vain\Config\ConfigInterface;
use Vain\Config\Factory\ConfigFactoryInterface;
use Vain\Phalcon\Config\PhalconConfig;

/**
 * Class PhalconConfigFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconConfigFactory implements ConfigFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createConfig(array $data = []) : ConfigInterface
    {
        return new PhalconConfig($data);
    }
}