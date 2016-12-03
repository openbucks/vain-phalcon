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
namespace Vain\Phalcon\Entity\Operation;

use Vain\Entity\Operation\AbstractDeleteEntityOperation;
use Vain\Operation\Result\Failed\FailedOperationResult;
use Vain\Operation\Result\OperationResultInterface;
use Vain\Operation\Result\Successful\SuccessfulOperationResult;
use Vain\Phalcon\Entity\AbstractEntity;

/**
 * Class PhalconDeleteEntityOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method AbstractEntity getEntity
 */
class PhalconDeleteEntityOperation extends AbstractDeleteEntityOperation
{
    /**
     * @inheritDoc
     */
    public function execute() : OperationResultInterface
    {
        if (false === $this->getEntity()->delete()) {
            return new FailedOperationResult();
        }

        return new SuccessfulOperationResult();
    }
}