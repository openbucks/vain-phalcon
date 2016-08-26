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
 * Class BadRedirectCodeException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BadRedirectCodeException extends ResponseException
{
    /**
     * BadRedirectCodeException constructor.
     *
     * @param AbstractResponse $response
     * @param string           $code
     */
    public function __construct(AbstractResponse $response, $code)
    {
        parent::__construct($response, sprintf('Unsupported code %d for redirection', $code), 0, null);
    }
}