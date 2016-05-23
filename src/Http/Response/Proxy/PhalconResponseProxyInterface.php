<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:38 AM
 */

namespace Vain\Phalcon\Http\Response\Proxy;

use Vain\Http\Response\VainResponseInterface;
use Phalcon\Http\ResponseInterface as PhalconHttpResponseInterface;

interface PhalconResponseProxyInterface
{
    /**
     * @param VainResponseInterface $vainResponse
     * 
     * @return PhalconResponseProxyInterface
     */
    public function addResponse(VainResponseInterface $vainResponse);

    /**
     * @return VainResponseInterface
     */
    public function popResponse();

    /**
     * @return PhalconHttpResponseInterface
     */
    public function getCurrentResponse();
}