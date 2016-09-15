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

use Phalcon\Db\AdapterInterface as PhalconDatabaseInterface;
use Vain\Database\DatabaseInterface;
use Vain\Database\Generator\Generator;
use Vain\Phalcon\Database\Cursor\PhalconCursor;
use Vain\Phalcon\Exception\PhalconQueryException;

/**
 * Class PhalconDatabase
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconDatabase implements DatabaseInterface
{
    private $phalconDatabase;

    /**
     * PhalconDatabase constructor.
     *
     * @param PhalconDatabaseInterface $phalconDatabase
     */
    public function __construct(PhalconDatabaseInterface $phalconDatabase)
    {
        $this->phalconDatabase = $phalconDatabase;
    }

    /**
     * @inheritDoc
     */
    public function transaction()
    {
        return $this->phalconDatabase->begin();
    }

    /**
     * @inheritDoc
     */
    public function commit()
    {
        return $this->phalconDatabase->commit();
    }

    /**
     * @inheritDoc
     */
    public function rollback()
    {
        return $this->phalconDatabase->rollback();
    }

    /**
     * @inheritDoc
     */
    public function query($query, array $bindParams)
    {
        if (false === ($result = $this->phalconDatabase->query($query, $bindParams))) {
            throw new PhalconQueryException($this, $query);
        }

        return new Generator($this, new PhalconCursor($result));
    }
}