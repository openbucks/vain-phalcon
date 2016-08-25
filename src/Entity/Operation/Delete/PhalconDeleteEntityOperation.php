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
namespace Vain\Phalcon\Entity\Operation\Delete;

use Vain\Entity\Operation\Delete\AbstractDeleteEntityOperation;
use Vain\Operation\Result\Failed\FailedOperationResult;
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
    public function execute()
    {
        if (false === $this->getEntity()->delete()) {
            return new FailedOperationResult();
        }

        return new SuccessfulOperationResult();
    }
}