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
use Vain\Database\Generator\Factory\GeneratorFactoryInterface;
use Vain\Database\Generator\GeneratorInterface;
use Vain\Phalcon\Database\Cursor\PhalconCursor;
use Vain\Phalcon\Exception\PhalconQueryException;
use Vain\Database\AbstractDatabase;

/**
 * Class PhalconDatabase
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconDatabase extends AbstractDatabase
{
    private $phalconDatabase;

    /**
     * PhalconDatabase constructor.
     *
     * @param GeneratorFactoryInterface $generatorFactory
     * @param PhalconDatabaseInterface  $phalconDatabase
     */
    public function __construct(GeneratorFactoryInterface $generatorFactory, PhalconDatabaseInterface $phalconDatabase)
    {
        $this->phalconDatabase = $phalconDatabase;
        parent::__construct($generatorFactory);
    }

    /**
     * @inheritDoc
     */
    public function startTransaction() : bool
    {
        return $this->phalconDatabase->begin();
    }

    /**
     * @inheritDoc
     */
    public function commitTransaction() : bool
    {
        return $this->phalconDatabase->commit();
    }

    /**
     * @inheritDoc
     */
    public function rollbackTransaction() : bool
    {
        return $this->phalconDatabase->rollback();
    }

    /**
     * @inheritDoc
     */
    public function runQuery($query, array $bindParams) : GeneratorInterface
    {
        if (false === ($result = $this->phalconDatabase->query($query, $bindParams))) {
            throw new PhalconQueryException($this, $query);
        }

        return $this->getGeneratorFactory()->create($this, new PhalconCursor($result));
    }
}