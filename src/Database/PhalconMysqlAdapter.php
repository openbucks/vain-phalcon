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

namespace Vain\Phalcon\Database;

use Phalcon\Db\Adapter\Pdo\Mysql as PhalconMysqlDatabase;
use Vain\Core\Connection\ConnectionInterface;
use Vain\Core\Database\Generator\Factory\DatabaseGeneratorFactoryInterface;
use Vain\Core\Database\Generator\DatabaseGeneratorInterface;
use Vain\Core\Database\Mvcc\MvccDatabaseInterface;
use Vain\Phalcon\Database\Cursor\PhalconCursor;
use Vain\Phalcon\Exception\PhalconQueryException;

/**
 * Class PhalconMysqlAdapter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconMysqlAdapter extends PhalconMysqlDatabase implements MvccDatabaseInterface
{
    private $generatorFactory;

    private $connection;

    /**
     * PhalconPostgresqlAdapter constructor.
     *
     * @param DatabaseGeneratorFactoryInterface $generatorFactory
     * @param ConnectionInterface       $connection
     */
    public function __construct(DatabaseGeneratorFactoryInterface $generatorFactory, ConnectionInterface $connection)
    {
        $this->generatorFactory = $generatorFactory;
        $this->connection = $connection;
        parent::__construct([]);
    }

    /**
     * @inheritDoc
     */
    public function connect(array $descriptor = null)
    {
        if (null === $this->_pdo) {
            $this->_pdo = $this->connection->establish();
        }

        return $this->_pdo;
    }

    /**
     * @inheritDoc
     */
    public function startTransaction() : bool
    {
        return $this->begin();
    }

    /**
     * @inheritDoc
     */
    public function commitTransaction() : bool
    {
        return $this->commit();
    }

    /**
     * @inheritDoc
     */
    public function rollbackTransaction() : bool
    {
        return $this->rollback();
    }

    /**
     * @inheritDoc
     */
    public function runQuery($query, array $bindParams, array $bindTypes = []) : DatabaseGeneratorInterface
    {
        if (false === ($result = $this->query($query, $bindParams, $bindTypes))) {
            throw new PhalconQueryException($this, $query);
        }

        return $this->generatorFactory->create($this, new PhalconCursor($result));
    }
}
