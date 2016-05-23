<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:15 AM
 */

namespace Vain\Phalcon\Http\Request\Proxy;

use Vain\Phalcon\Http\Request\PhalconRequestInterface;

interface PhalconRequestProxyInterface extends PhalconRequestInterface
{
    /**
     * @param PhalconRequestInterface $phalconRequest
     *
     * @return PhalconRequestProxyInterface
     */
    public function addRequest(PhalconRequestInterface $phalconRequest);

    /**
     * @return PhalconRequestInterface
     */
    public function popRequest();

    /**
     * @return PhalconRequestInterface
     */
    public function getCurrentRequest();
}