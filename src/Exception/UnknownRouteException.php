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
use Vain\Api\Exception\ConfigProviderException;
use Vain\Http\Request\VainServerRequestInterface;

/**
 * Class UnknownRouteException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnknownRouteException extends ConfigProviderException
{
    private $request;

    /**
     * UnknownRouteException constructor.
     *
     * @param ApiConfigProviderInterface $apiConfigProvider
     * @param VainServerRequestInterface $request
     */
    public function __construct(ApiConfigProviderInterface $apiConfigProvider, VainServerRequestInterface $request)
    {
        $this->request = $request;
        parent::__construct($apiConfigProvider, 'Not found', 404);
    }
}