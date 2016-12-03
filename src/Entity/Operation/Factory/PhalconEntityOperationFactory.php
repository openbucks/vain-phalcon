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

use Vain\Entity\EntityInterface;
use Vain\Entity\Operation\Factory\EntityOperationFactoryInterface;
use Vain\Operation\OperationInterface;
use Vain\Phalcon\Entity\Operation\PhalconCreateEntityOperation;
use Vain\Phalcon\Entity\Operation\PhalconDeleteEntityOperation;
use Vain\Phalcon\Entity\Operation\PhalconUpdateEntityOperation;

/**
 * Class PhalconEntityOperationFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconEntityOperationFactory implements EntityOperationFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createEntity(EntityInterface $entity) : OperationInterface
    {
        return new PhalconCreateEntityOperation($entity);
    }

    /**
     * @inheritDoc
     */
    public function updateEntity(EntityInterface $newEntity, EntityInterface $oldEntity) : OperationInterface
    {
        return new PhalconUpdateEntityOperation($newEntity, $oldEntity);
    }

    /**
     * @inheritDoc
     */
    public function deleteEntity(EntityInterface $entity) : OperationInterface
    {
        return new PhalconDeleteEntityOperation($entity);
    }
}