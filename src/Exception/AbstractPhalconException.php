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

namespace Vain\Phalcon\Exception;

use Phalcon\Exception as PhalconException;
use Vain\Core\Exception\CoreExceptionInterface;

/**
 * Class AbstractPhalconException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractPhalconException extends PhalconException implements CoreExceptionInterface
{
}