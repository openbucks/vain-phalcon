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
use Vain\Http\Response\VainResponseInterface;

/**
 * Class JsonErrorException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class JsonErrorException extends ResponseException
{
    /**
     * JsonErrorException constructor.
     * @param VainResponseInterface $response
     * @param string $content
     */
    public function __construct(VainResponseInterface $response, $content)
    {
        parent::__construct($response, sprintf('Unable to encode content %s', $content), 0, null);
    }
}