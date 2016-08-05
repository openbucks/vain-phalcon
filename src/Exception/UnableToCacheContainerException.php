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

use Vain\Phalcon\Di\Factory\DiFactoryInterface;

/**
 * Class UnableToCacheContainerException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnableToCacheContainerException extends DiFactoryException
{
    /**
     * UnableToCacheContainerException constructor.
     *
     * @param DiFactoryInterface $diFactory
     * @param string             $filename
     */
    public function __construct(DiFactoryInterface $diFactory, $filename)
    {
        parent::__construct($diFactory, sprintf('Unable to write container to %s', $filename), 0, null);
    }
}