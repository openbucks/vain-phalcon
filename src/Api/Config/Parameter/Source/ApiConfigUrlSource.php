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
declare(strict_types = 1);

namespace Vain\Phalcon\Api\Config\Parameter\Source;

use Psr\Http\Message\ServerRequestInterface;
use Vain\Core\Api\Config\Parameter\Result\ApiConfigParameterResultInterface;
use Vain\Core\Api\Config\Parameter\Source\AbstractApiConfigParameterSource;
use Vain\Phalcon\Dispatcher\Mvc\MvcDispatcher;

/**
 * Class ApiConfigUrlSource
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiConfigUrlSource extends AbstractApiConfigParameterSource
{
    private $mvcDispatcher;

    /**
     * AbstractApiParameterConfigSourceModule constructor.
     *
     * @param MvcDispatcher $mvcDispatcher
     * @param string        $source
     * @param string        $destination
     * @param bool          $isOptional
     * @param mixed         $defaultValue
     */
    public function __construct(
        MvcDispatcher $mvcDispatcher,
        string $source,
        string $destination,
        bool $isOptional = false,
        $defaultValue = null
    ) {
        $this->mvcDispatcher = $mvcDispatcher;
        parent::__construct($source, $destination, $isOptional, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function extract(ServerRequestInterface $serverRequest): ApiConfigParameterResultInterface
    {
        return $this->process($this->mvcDispatcher->getParams());
    }
}
