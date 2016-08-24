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
namespace Vain\Phalcon\Entity\Operation\Create;

use Vain\Entity\Operation\Create\AbstractCreateEntityOperation;
use Vain\Operation\Result\Failed\FailedOperationResult;
use Vain\Operation\Result\Successful\SuccessfulOperationResult;
use Vain\Phalcon\Entity\AbstractEntity;

/**
 * Class PhalconCreateEntityOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method AbstractEntity getEntity
 */
class PhalconCreateEntityOperation extends AbstractCreateEntityOperation
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        if (false === $this->getEntity()->save()) {
            return new FailedOperationResult();
        }

        return new SuccessfulOperationResult();
    }
}