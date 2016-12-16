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
 * Class JsonErrorException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class JsonErrorException extends ResponseException
{
    /**
     * JsonErrorException constructor.
     *
     * @param AbstractResponse $response
     * @param string           $content
     */
    public function __construct(AbstractResponse $response, $content)
    {
        parent::__construct($response, sprintf('Unable to encode content %s', $content));
    }
}
