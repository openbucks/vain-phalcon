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

use Vain\Database\Exception\DatabaseFactoryException;
use Vain\Database\Factory\DatabaseFactoryInterface;

/**
 * Class UnknownPhalconDriverException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnknownPhalconTypeException extends DatabaseFactoryException
{
    /**
     * UnknownPhalconDriverException constructor.
     *
     * @param DatabaseFactoryInterface $databaseFactory
     * @param string                   $driver
     */
    public function __construct(DatabaseFactoryInterface $databaseFactory, string $driver)
    {
        parent::__construct($databaseFactory, sprintf('Cannot create phalcon database of unknown type %s', $driver));
    }
}