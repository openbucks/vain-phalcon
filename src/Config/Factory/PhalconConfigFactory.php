<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/19/16
 * Time: 11:57 AM
 */

namespace Vain\Phalcon\Config\Factory;

use Vain\Config\Factory\ConfigFactoryInterface;
use Vain\Phalcon\Config\PhalconConfig;

class PhalconConfigFactory implements ConfigFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createConfig(array $data = [])
    {
        return new PhalconConfig($data);
    }
}