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
use Vain\Phalcon\Entity\Operation\Create\PhalconCreateEntityOperation;
use Vain\Phalcon\Entity\Operation\Delete\PhalconDeleteEntityOperation;
use Vain\Phalcon\Entity\Operation\Update\PhalconUpdateEntityOperation;

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
    public function create(EntityInterface $entity) : OperationInterface
    {
        return new PhalconCreateEntityOperation($entity);
    }

    /**
     * @inheritDoc
     */
    public function update(EntityInterface $entity) : OperationInterface
    {
        return new PhalconUpdateEntityOperation($entity);
    }

    /**
     * @inheritDoc
     */
    public function delete(EntityInterface $entity) : OperationInterface
    {
        return new PhalconDeleteEntityOperation($entity);
    }
}