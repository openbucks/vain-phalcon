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

namespace Vain\Phalcon\Api\Request\Validator\Module\Source\Dispatcher;

use Vain\Api\Config\Parameter\ApiParameterConfigInterface;
use Vain\Api\Request\Validator\Module\AbstractApiValidatorModule;
use Vain\Http\Request\VainServerRequestInterface;
use Vain\Phalcon\Dispatcher\Mvc\MvcDispatcher;

/**
 * Class ApiValidatorDispatcherModule
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiValidatorDispatcherModule extends AbstractApiValidatorModule
{
    private $mvcDispatcher;

    /**
     * ApiValidatorDispatcherModule constructor.
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
    public function validate(VainServerRequestInterface $serverRequest, ApiParameterConfigInterface $parameterConfig)
    {
        return [
            $parameterConfig->getName() => $this->mvcDispatcher->getParam(
                $parameterConfig->getSourceName(),
                [],
                $parameterConfig->getDefaultValue()
            ),
        ];
    }
}