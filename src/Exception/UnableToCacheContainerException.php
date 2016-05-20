<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 12:10 PM
 */

namespace Vain\Phalcon\Exception;

use Vain\Phalcon\Di\Factory\DiFactoryInterface;

class UnableToCacheContainerException extends DiFactoryException
{
    /**
     * UnableToCacheContainerException constructor.
     * @param DiFactoryInterface $di
     * @param string $filename
     */
    public function __construct(DiFactoryInterface $di, $filename)
    {
        parent::__construct($di, sprintf('Unable to write container to %s', $filename), 0 ,null);
    }
}