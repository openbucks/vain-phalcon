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

use Vain\Core\Exception\ResponseException;
use Vain\Core\Http\Response\AbstractResponse;

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
        parent::__construct($response, sprintf('Unsupported code %d for redirection', $code));
    }
}
