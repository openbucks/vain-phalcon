<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/13/16
 * Time: 11:38 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Exception\ResponseException;
use Vain\Http\Response\VainResponseInterface;

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