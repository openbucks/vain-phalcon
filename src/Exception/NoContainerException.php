<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-phalcon
 */
namespace Vain\Phalcon\Exception;

use Vain\Phalcon\Di\Builder\DiBuilderInterface;

/**
 * Class NoContainerException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NoContainerException extends DiBuilderException
{
    /**
     * NoContainerException constructor.
     *
     * @param DiBuilderInterface $builder
     */
    public function __construct(DiBuilderInterface $builder)
    {
        parent::__construct($builder, 'No container to build');
    }
}