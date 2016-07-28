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
namespace Vain\Phalcon\Exception;

use Vain\Api\Config\Provider\ApiConfigProviderInterface;
use Vain\Api\Exception\ApiConfigProviderException;
use Vain\Http\Request\VainServerRequestInterface;
use Phalcon\Mvc\Router\RouteInterface as PhalconMvcRouteInterface;

/**
 * Class NoConfigDataException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NoConfigDataException extends ApiConfigProviderException
{
    private $request;

    /**
     * NoConfigDataException constructor.
     *
     * @param ApiConfigProviderInterface $apiConfigProvider
     * @param VainServerRequestInterface $request
     * @param PhalconMvcRouteInterface   $matchedRoute
     */
    public function __construct(
        ApiConfigProviderInterface $apiConfigProvider,
        VainServerRequestInterface $request,
        PhalconMvcRouteInterface $matchedRoute
    ) {
        $this->request = $request;
        parent::__construct($apiConfigProvider, sprintf('Cannot find api config for route %s', $matchedRoute->getName()), 0, null);
    }

    /**
     * @return VainServerRequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}