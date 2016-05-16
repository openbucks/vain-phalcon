<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/16/16
 * Time: 9:53 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Request\Factory\RequestFactoryInterface;

class UnknownFilesException extends HttpFactoryException
{
    /**
     * UnknownFilesException constructor.
     * @param RequestFactoryInterface $factory
     * @param string $fileKey
     */
    public function __construct(RequestFactoryInterface $factory, $fileKey)
    {
        parent::__construct($factory, sprintf('Cannot parse files array at key %s', $fileKey), 0, null);
    }
}