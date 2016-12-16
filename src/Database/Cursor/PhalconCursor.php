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

namespace Vain\Phalcon\Database\Cursor;

use Phalcon\Db\ResultInterface as PhalconDbResultInterface;
use Vain\Core\Database\Cursor\DatabaseCursorInterface;

/**
 * Class PhalconCursor
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconCursor implements DatabaseCursorInterface
{
    private $phalconDbResult;

    /**
     * PhalconCursor constructor.
     *
     * @param PhalconDbResultInterface $phalconDbResult
     */
    public function __construct(PhalconDbResultInterface $phalconDbResult)
    {
        $this->phalconDbResult = $phalconDbResult;
    }

    /**
     * @inheritDoc
     */
    public function valid() : bool
    {
        return ($this->phalconDbResult->getInternalResult()->errorCode() === '00000');
    }

    /**
     * @inheritDoc
     */
    public function current() : array
    {
        return $this->phalconDbResult->fetch();
    }

    /**
     * @inheritDoc
     */
    public function next() : bool
    {
        return $this->phalconDbResult->getInternalResult()->nextRowset();
    }

    /**
     * @inheritDoc
     */
    public function close() : DatabaseCursorInterface
    {
        $this->phalconDbResult->getInternalResult()->closeCursor();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function mode(int $mode) : DatabaseCursorInterface
    {
        $this->phalconDbResult->setFetchMode($mode);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSingle() : array
    {
        return $this->phalconDbResult->fetch();
    }

    /**
     * @inheritDoc
     */
    public function getAll() : array
    {
        return $this->phalconDbResult->fetchAll();
    }

    /**
     * @inheritDoc
     */
    public function count() : int
    {
        return $this->phalconDbResult->numRows();
    }
}
