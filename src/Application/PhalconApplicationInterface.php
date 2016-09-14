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
namespace Vain\Phalcon\Application;

use Phalcon\Di\InjectionAwareInterface as PhalconDiAwareInterface;
use Phalcon\DiInterface as PhalconDiInterface;
use Vain\Phalcon\Application\Module\PhalconApplicationModuleInterface;

/**
 * Interface ApplicationInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconDiInterface getDI
 */
interface PhalconApplicationInterface extends PhalconDiAwareInterface
{
    /**
     * @param string                            $alias
     * @param PhalconApplicationModuleInterface $applicationModule
     *
     * @return PhalconApplicationInterface
     */
    public function addModule($alias, PhalconApplicationModuleInterface $applicationModule);

    /**
     * @return PhalconApplicationModuleInterface[]
     */
    public function getApplicationModules();
}