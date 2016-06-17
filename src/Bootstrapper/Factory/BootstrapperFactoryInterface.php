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

use Vain\Phalcon\Bootstrapper\BootstrapperInterface;

/**
 * Interface BootstrapperFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface BootstrapperFactoryInterface
{
    /**
     * @return BootstrapperInterface
     */
    public function createBootstrapper();
}