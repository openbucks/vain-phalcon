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
declare(strict_types = 1);

namespace Vain\Phalcon\Exception;

use Vain\Phalcon\Di\Factory\DiFactoryInterface;

/**
 * Class NoCoreParametersException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NoCoreParametersException extends DiFactoryException
{
    /**
     * NoCoreParametersException constructor.
     *
     * @param DiFactoryInterface $diFactory
     */
    public function __construct(DiFactoryInterface $diFactory)
    {
        parent::__construct($diFactory, 'Some core parameters %app.dir%, %app.config.dir% are missing from container');
    }
}
