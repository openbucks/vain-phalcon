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
use Vain\Database\Cursor\CursorInterface;

/**
 * Class PhalconCursor
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconCursor implements CursorInterface
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
    public function valid()
    {
        return ($this->phalconDbResult->getInternalResult()->errorCode() === '00000');
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->phalconDbResult->fetch();
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        return $this->phalconDbResult->getInternalResult()->nextRowset();
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        $this->phalconDbResult->getInternalResult()->closeCursor();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function mode($mode)
    {
        $this->phalconDbResult->setFetchMode($mode);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSingle()
    {
        return $this->phalconDbResult->fetch();
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        return $this->phalconDbResult->fetchAll();
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->phalconDbResult->numRows();
    }
}