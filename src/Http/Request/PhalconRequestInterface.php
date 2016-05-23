<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:04 AM
 */

namespace Vain\Phalcon\Http\Request;

use Phalcon\Http\RequestInterface as PhalconHttpRequestInterface;
use Vain\Http\Request\VainServerRequestInterface;

interface PhalconRequestInterface extends VainServerRequestInterface, PhalconHttpRequestInterface
{

}