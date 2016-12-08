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

use Vain\Api\Config\Parameter\ApiParameterConfigInterface;
use Vain\Api\Request\Validator\Module\ApiValidatorModuleInterface;
use Vain\Api\Request\Validator\Module\Factory\AbstractApiValidatorModuleFactory;
use Vain\Phalcon\Api\Request\Validator\Module\Source\Dispatcher\ApiValidatorDispatcherModule;
use Vain\Phalcon\Dispatcher\Mvc\MvcDispatcher;

/**
 * Class ApiValidatorDispatcherModuleFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiValidatorDispatcherModuleFactory extends AbstractApiValidatorModuleFactory
{

    private $mvcDispatcher;

    /**
     * ApiValidatorDispatcherModuleFactory constructor.
     *
     * @param MvcDispatcher $mvcDispatcher
     * @param array         $names
     */
    public function __construct(MvcDispatcher $mvcDispatcher, array $names)
    {
        $this->mvcDispatcher = $mvcDispatcher;
        parent::__construct($names);
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
