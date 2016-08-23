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

use Vain\Phalcon\Di\Builder\DiBuilderInterface;

/**
 * Class UnableToCacheContainerException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnableToCacheContainerException extends DiBuilderException
{
    /**
     * UnableToCacheContainerException constructor.
     *
     * @param DiBuilderInterface $builder
     * @param string             $filename
     */
    public function __construct(DiBuilderInterface $builder, $filename)
    {
        parent::__construct($builder, sprintf('Unable to write container to %s', $filename), 0, null);
    }
}