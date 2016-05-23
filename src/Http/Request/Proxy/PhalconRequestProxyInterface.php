<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:15 AM
 */

namespace Vain\Phalcon\Http\Request\Proxy;

use Vain\Http\Request\VainServerRequestInterface;
use Vain\Phalcon\Http\Request\PhalconRequestInterface;

interface PhalconRequestProxyInterface extends PhalconRequestInterface
{
    /**
     * @param VainServerRequestInterface $phalconRequest
     *
     * @return PhalconRequestProxyInterface
     */
    public function addRequest(VainServerRequestInterface $phalconRequest);

    /**
     * @return VainServerRequestInterface
     */
    public function popRequest();

    /**
     * @return PhalconRequestInterface
     */
    public function getCurrentRequest();
}