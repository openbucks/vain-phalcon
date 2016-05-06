<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/5/16
 * Time: 10:46 AM
 */

namespace Vain\Phalcon\Entity;

use Phalcon\Mvc\Model as PhalconMvcModel;
use Vain\Entity\EntityInterface;

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