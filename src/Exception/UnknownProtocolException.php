<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/16/16
 * Time: 9:14 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Request\Factory\RequestFactoryInterface;

class UnknownProtocolException extends HttpFactoryException
{
    /**
     * UnknownProtocolException constructor.
     * @param RequestFactoryInterface $factory
     * @param string $protocol
     */
    public function __construct(RequestFactoryInterface $factory, $protocol)
    {
        parent::__construct($factory, sprintf('Cannot extract http protocol from %s', $protocol), 0, null);
    }
}