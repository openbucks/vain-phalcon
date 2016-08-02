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
namespace Vain\Phalcon\Api\Config\Factory;

use Vain\Api\Config\Factory\ApiConfigFactoryInterface;
use Vain\Phalcon\Api\Config\PhalconApiConfig;

/**
 * Class PhalconApiConfigFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApiConfigFactory implements ApiConfigFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createConfig($moduleName, $routeName, array $configData)
    {
        return new PhalconApiConfig($moduleName, $routeName, $configData);
    }
}