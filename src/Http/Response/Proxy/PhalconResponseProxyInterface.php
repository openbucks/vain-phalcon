<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:38 AM
 */

namespace Vain\Phalcon\Http\Response\Proxy;


use Vain\Http\Response\VainResponseInterface;
use Vain\Phalcon\Http\Response\PhalconResponseInterface;

interface PhalconResponseProxyInterface extends PhalconResponseInterface
{
    /**
     * @param VainResponseInterface $vainResponse
     * 
     * @return PhalconResponseProxyInterface
     */
    public function addResponse(VainResponseInterface $vainResponse);

    /**
     * @return PhalconResponseInterface
     */
    public function popResponse();

    /**
     * @return PhalconResponseInterface
     */
    public function getCurrentResponse();
}