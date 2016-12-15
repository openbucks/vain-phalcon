<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
namespace Vain\Phalcon\Entity;

use Phalcon\Mvc\Model as PhalconMvcModel;
use Phalcon\Mvc\Model\Criteria as PhalconCriteria;
use Vain\Core\Entity\EntityInterface;
use Phalcon\Di as PhalconDi;
use Phalcon\DiInterface as PhalconDiInterface;

/**
 * Class AbstractEntity
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractEntity extends PhalconMvcModel implements EntityInterface
{
    /**
     * @inheritDoc
     */
    public function getPrimaryKey()
    {
        $method = 'getId';
        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        } else {
            return $this->id;
        }
    }

    /**
     * @inheritDoc
     */
    public static function query(PhalconDiInterface $di = null)
    {
        if (null === $di) {
            $di = PhalconDi::getDefault();
        }

        $criteria = new PhalconCriteria();
        $criteria->setDI($di);
        $criteria->setModelName(get_called_class());

        return $criteria;
    }
}
