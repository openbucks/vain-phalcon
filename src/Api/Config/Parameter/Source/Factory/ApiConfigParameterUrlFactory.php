<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-api
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-api
 */

namespace Vain\Phalcon\Api\Config\Parameter\Source\Factory;

use Vain\Core\Api\Config\Parameter\Source\ApiConfigParameterSourceInterface;
use Vain\Core\Api\Config\Parameter\Source\Factory\ApiConfigParameterSourceFactoryInterface;
use Vain\Phalcon\Api\Config\Parameter\Source\ApiConfigUrlSource;
use Vain\Phalcon\Dispatcher\Mvc\MvcDispatcher;

/**
 * Class ApiConfigParameterUrlFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiConfigParameterUrlFactory implements ApiConfigParameterSourceFactoryInterface
{
    private $mvcDispatcher;

    /**
     * AbstractApiParameterConfigSourceModule constructor.
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
    public function getName(): string
    {
        return 'url';
    }

    /**
     * @inheritDoc
     */
    public function createSource($name, array $config): ApiConfigParameterSourceInterface
    {
        return new ApiConfigUrlSource(
            $this->mvcDispatcher,
            $config['source_name'] ?? $name,
            $name,
            $config['optional'] ?? false,
            $config['default'] ?? null
        );
    }
}
