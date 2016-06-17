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
namespace Vain\Phalcon\Bootstrapper;

use Phalcon\Di\Injectable as PhalconDiInjectable;

/**
 * Interface BootstrapperInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface BootstrapperInterface
{
    /**
     * @param PhalconDiInjectable $application     
     *
     * @return BootstrapperInterface
     */
    public function bootstrap(PhalconDiInjectable $application);
}