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

/**
 * Interface ApplicationInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconDiInterface getDI
 */
interface PhalconApplicationInterface extends PhalconDiAwareInterface
{
}