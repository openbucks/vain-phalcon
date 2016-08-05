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
namespace Vain\Phalcon\Di\Compile;

use \Phalcon\DiInterface as PhalconDiInterface;

/**
 * Interface CompileAwareContainerInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CompileAwareContainerInterface extends PhalconDiInterface
{
    /**
     * @return bool
     */
    public function isFrozen();

    /**
     * @return bool
     */
    public function compile();
}