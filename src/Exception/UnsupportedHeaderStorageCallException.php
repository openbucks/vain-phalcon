<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/13/16
 * Time: 11:59 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Exception\HeaderStorageException;
use Vain\Http\Header\Storage\HeaderStorageInterface;

class UnsupportedHeaderStorageCallException extends HeaderStorageException
{
    /**
     * UnsupportedHeaderStorageCallException constructor.
     * @param HeaderStorageInterface $headerStorage
     * @param string $method
     */
    public function __construct(HeaderStorageInterface $headerStorage, $method)
    {
        parent::__construct($headerStorage, sprintf('Call to method %s on header storage object is not supported', $method), 0, null);
    }
}