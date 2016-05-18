<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/18/16
 * Time: 11:05 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Exception\ResponseException;
use Vain\Http\Response\VainResponseInterface;

class BadRedirectCodeException extends ResponseException
{
    /**
     * BadRedirectCodeException constructor.
     * @param VainResponseInterface $response
     * @param string $code
     */
    public function __construct(VainResponseInterface $response, $code)
    {
        parent::__construct($response, sprintf('Unsupported code %d for redirection', $code), 0 ,null);
    }
}