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
namespace Vain\Phalcon\Api\Config;

use Vain\Api\Config\ApiConfigInterface;

/**
 * Class PhalconApiConfig
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApiConfig implements ApiConfigInterface
{
    private $configData;

    /**
     * PhalconApiConfig constructor.
     *
     * @param array $configData
     */
    public function __construct(array $configData)
    {
        $this->configData = $configData;
    }

    /**
     * @inheritDoc
     */
    public function getHandlerAlias()
    {
        trigger_error('Method getHandlerAlias is not implemented', E_USER_ERROR);
    }
}