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
declare(strict_types = 1);

namespace Vain\Phalcon\Exception;

use Vain\Api\Config\Provider\ApiConfigProviderInterface;
use Vain\Api\Exception\ConfigProviderException;
use Vain\Http\Request\VainServerRequestInterface;

/**
 * Class NoModuleConfigDataException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NoModuleConfigDataException extends ConfigProviderException
{
    private $request;

    /**
     * NoConfigDataException constructor.
     *
     * @param ApiConfigProviderInterface $apiConfigProvider
     * @param VainServerRequestInterface $request
     * @param string                     $moduleName
     */
    public function __construct(
        ApiConfigProviderInterface $apiConfigProvider,
        VainServerRequestInterface $request,
        $moduleName
    ) {
        $this->request = $request;
        parent::__construct($apiConfigProvider, sprintf('Cannot find api config for module %s', $moduleName));
    }

    /**
     * @return VainServerRequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}