<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */

namespace Vain\Phalcon\Http\Header\Factory;

use Vain\Http\Header\Factory\HeaderFactoryInterface;
use Vain\Phalcon\Http\Header\PhalconHeader;

/**
 * Class PhalconHeaderFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconHeaderFactory implements HeaderFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createHeader($name, $value)
    {
        $transformedValue = $value;
        if (false === is_array($value)) {
            $transformedValue = [$value];
        }

        return new PhalconHeader($name, $transformedValue);
    }
}