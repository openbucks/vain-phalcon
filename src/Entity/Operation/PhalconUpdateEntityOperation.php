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

use Vain\Entity\Operation\AbstractUpdateEntityOperation;
use Vain\Core\Result\FailedResult;
use Vain\Core\Result\ResultInterface;
use Vain\Core\Result\SuccessfulResult;
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
    public function execute() : ResultInterface
    {
        if (false === $this->getEntity()->save()) {
            return new FailedResult();
        }

        return new SuccessfulResult();
    }
}
