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
declare(strict_types=1);

namespace Vain\Phalcon\Exception;

use Vain\Database\DatabaseInterface;
use Vain\Database\Exception\DatabaseException;

/**
 * Class PhalconQueryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconQueryException extends DatabaseException
{
    /**
     * PhalconQueryException constructor.
     *
     * @param DatabaseInterface $vainDatabase
     * @param string            $query
     */
    public function __construct(DatabaseInterface $vainDatabase, $query)
    {
        parent::__construct($vainDatabase, sprintf('Cannot execute query %s', $query));
    }
}
