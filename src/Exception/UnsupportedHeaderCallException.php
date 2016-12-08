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
declare(strict_types = 1);

namespace Vain\Phalcon\Exception;

use Vain\Http\Exception\HeaderException;
use Vain\Http\Header\VainHeaderInterface;

/**
 * Class UnsupportedHeaderCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedHeaderCallException extends HeaderException
{
    /**
     * UnsupportedHeaderCallException constructor.
     *
     * @param VainHeaderInterface $header
     * @param string              $method
     */
    public function __construct(VainHeaderInterface $header, $method)
    {
        parent::__construct($header, sprintf('Call to method %s on header object is not supported', $method));
    }
}
