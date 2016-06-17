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
use Vain\Entity\EntityInterface;

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
}