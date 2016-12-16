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
namespace Vain\Phalcon\Entity\Operation\Factory;

use Vain\Core\Entity\EntityInterface;
use Vain\Core\Entity\Operation\Factory\AbstractEntityOperationFactory;
use Vain\Core\Entity\Operation\Factory\EntityOperationFactoryInterface;
use Vain\Core\Operation\OperationInterface;
use Vain\Phalcon\Entity\Operation\PhalconCreateEntityOperation;
use Vain\Phalcon\Entity\Operation\PhalconDeleteEntityOperation;
use Vain\Phalcon\Entity\Operation\PhalconUpdateEntityOperation;

/**
 * Class PhalconEntityOperationFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconEntityOperationFactory extends AbstractEntityOperationFactory implements EntityOperationFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createEntity(EntityInterface $entity) : OperationInterface
    {
        return $this->decorate(new PhalconCreateEntityOperation($entity));
    }

    /**
     * @inheritDoc
     */
    public function doUpdateEntity(EntityInterface $newEntity, EntityInterface $oldEntity) : OperationInterface
    {
        return $this->decorate(new PhalconUpdateEntityOperation($newEntity, $oldEntity));
    }

    /**
     * @inheritDoc
     */
    public function deleteEntity(EntityInterface $entity) : OperationInterface
    {
        return $this->decorate(new PhalconDeleteEntityOperation($entity));
    }
}
