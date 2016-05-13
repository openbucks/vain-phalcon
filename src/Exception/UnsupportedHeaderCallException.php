<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/13/16
 * Time: 11:57 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Exception\HeaderException;
use Vain\Http\Header\VainHeaderInterface;

class UnsupportedHeaderCallException extends HeaderException
{
    /**
     * UnsupportedHeaderCallException constructor.
     * @param VainHeaderInterface $header
     * @param string $method
     */
    public function __construct(VainHeaderInterface $header, $method)
    {
        parent::__construct($header, sprintf('Call to method %s on header object is not supported', $method), 0, null);
    }
}