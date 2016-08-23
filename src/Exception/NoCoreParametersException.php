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
 * Class NoCoreParametersException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NoCoreParametersException extends DiBuilderException
{
    /**
     * NoCoreParametersException constructor.
     *
     * @param DiBuilderInterface $builder
     */
    public function __construct(DiBuilderInterface $builder)
    {
        parent::__construct($builder, 'Some core parameters %app.dir%, %app.config.dir% are missing from container', 0, null);
    }
}