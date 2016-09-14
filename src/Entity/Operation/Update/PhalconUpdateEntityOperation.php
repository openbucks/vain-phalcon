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
namespace Vain\Phalcon\Entity\Operation\Update;

use Vain\Entity\Operation\Update\AbstractUpdateEntityOperation;
use Vain\Operation\Result\Failed\FailedOperationResult;
use Vain\Operation\Result\OperationResultInterface;
use Vain\Operation\Result\Successful\SuccessfulOperationResult;
use Vain\Phalcon\Entity\AbstractEntity;

/**
 * Class PhalconCreateEntityOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method AbstractEntity getEntity
 */
class PhalconUpdateEntityOperation extends AbstractUpdateEntityOperation
{
    /**
     * @inheritDoc
     */
    public function execute() : OperationResultInterface
    {
        if (false === $this->getEntity()->save()) {
            return new FailedOperationResult();
        }

        return new SuccessfulOperationResult();
    }
}