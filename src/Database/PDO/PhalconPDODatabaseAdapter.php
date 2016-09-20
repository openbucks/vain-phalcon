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

namespace Vain\Phalcon\Database\PDO;

use Phalcon\Db\Adapter\Pdo as PhalconDbPDOAdapter;

/**
 * Class PhalconPDODatabaseAdapter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class PhalconPDODatabaseAdapter extends PhalconDbPDOAdapter
{
    /**
     * PhalconPDODatabaseAdapter constructor.
     *
     * @param \PDO  $pdoInstance
     */
    public function __construct(\PDO $pdoInstance)
    {
        $this->_pdo = $pdoInstance;
        parent::__construct([]);
    }

    /**
     * @inheritDoc
     */
    public function connect(array $descriptor = null)
    {
        trigger_error(sprintf('Direct call to the %s::%s has no effect', __CLASS__, __METHOD__), E_WARNING);

        return $this->_pdo;
    }
}