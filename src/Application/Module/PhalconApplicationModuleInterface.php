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

namespace Vain\Phalcon\Application\Module;

use Phalcon\Mvc\ModuleDefinitionInterface;

/**
 * Interface PhalconApplicationModuleInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface PhalconApplicationModuleInterface extends ModuleDefinitionInterface
{
    /**
     * @return string
     */
    public function getName();
}