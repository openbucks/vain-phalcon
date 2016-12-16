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

namespace Vain\Phalcon\Api\Request\Validator\Module\Source\Dispatcher\Factory;

use Vain\Core\Api\Config\Parameter\ApiParameterConfigInterface;
use Vain\Core\Api\Request\Validator\Module\ApiValidatorModuleInterface;
use Vain\Core\Api\Request\Validator\Module\Factory\ApiValidatorModuleFactoryInterface;
use Vain\Phalcon\Api\Request\Validator\Module\Source\Dispatcher\ApiValidatorDispatcherModule;
use Vain\Phalcon\Dispatcher\Mvc\MvcDispatcher;

/**
 * Class ApiValidatorDispatcherModuleFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiValidatorDispatcherModuleFactory implements ApiValidatorModuleFactoryInterface
{

    private $mvcDispatcher;

    /**
     * ApiValidatorDispatcherModuleFactory constructor.
     *
     * @param MvcDispatcher $mvcDispatcher
     */
    public function __construct(MvcDispatcher $mvcDispatcher)
    {
        $this->mvcDispatcher = $mvcDispatcher;
    }

    /**
     * @inheritDoc
     */
    public function getNames() : array
    {
        return ['dispatcher', 'url'];
    }

    /**
     * @inheritDoc
     */
    public function createModule(
        ApiParameterConfigInterface $apiParameterConfig,
        ApiValidatorModuleInterface $apiValidatorModule = null
    ) : ApiValidatorModuleInterface
    {
        return new ApiValidatorDispatcherModule($this->mvcDispatcher);
    }
}
