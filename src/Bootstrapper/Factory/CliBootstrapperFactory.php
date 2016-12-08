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
namespace Vain\Phalcon\Bootstrapper\Factory;

use Vain\Core\Bootstrapper\Bootstrapper;
use Vain\Core\Bootstrapper\BootstrapperInterface;
use Vain\Core\Bootstrapper\Factory\BootstrapperFactoryInterface;

/**
 * Class CliBootstrapperFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CliBootstrapperFactory implements BootstrapperFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createBootstrapper() : BootstrapperInterface
    {
        return new Bootstrapper();
    }
}
