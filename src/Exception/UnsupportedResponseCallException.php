<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/13/16
 * Time: 9:23 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Exception\ResponseException;
use Vain\Http\Response\VainResponseInterface;

class UnsupportedResponseCallException extends ResponseException
{
    /**
     * UnsupportedResponseCallException constructor.
     * @param VainResponseInterface $response
     * @param string $method
     */
    public function __construct(VainResponseInterface $response, $method)
    {
        parent::__construct($response, sprintf('Call to method %s on response object is not supported', $method), 0, null);
    }
}