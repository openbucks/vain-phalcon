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

use Vain\Http\Request\Factory\RequestFactoryInterface;

/**
 * Class UnknownProtocolException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnknownProtocolException extends HttpFactoryException
{
    /**
     * UnknownProtocolException constructor.
     *
     * @param RequestFactoryInterface $factory
     * @param string                  $protocol
     */
    public function __construct(RequestFactoryInterface $factory, $protocol)
    {
        parent::__construct($factory, sprintf('Cannot extract http protocol from %s', $protocol));
    }
}