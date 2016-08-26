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
namespace Vain\Phalcon\Exception;

use Vain\Http\Exception\ResponseException;
use Vain\Http\Response\AbstractResponse;

/**
 * Class UnsupportedResponseCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedResponseCallException extends ResponseException
{
    /**
     * UnsupportedResponseCallException constructor.
     *
     * @param AbstractResponse $response
     * @param string                $method
     */
    public function __construct(AbstractResponse $response, $method)
    {
        parent::__construct(
            $response,
            sprintf('Call to method %s on response object is not supported', $method),
            0,
            null
        );
    }
}