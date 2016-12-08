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

use Vain\Http\Exception\HeaderStorageException;
use Vain\Http\Header\Storage\HeaderStorageInterface;

/**
 * Class UnsupportedHeaderStorageCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedHeaderStorageCallException extends HeaderStorageException
{
    /**
     * UnsupportedHeaderStorageCallException constructor.
     *
     * @param HeaderStorageInterface $headerStorage
     * @param string                 $method
     */
    public function __construct(HeaderStorageInterface $headerStorage, $method)
    {
        parent::__construct(
            $headerStorage,
            sprintf('Call to method %s on header storage object is not supported', $method)
        );
    }
}
