<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:38 AM
 */

namespace Vain\Phalcon\Http\Response;

use Phalcon\Http\ResponseInterface as PhalconHttpResponseInterface;
use Vain\Http\Response\VainResponseInterface;

interface PhalconResponseInterface extends VainResponseInterface, PhalconHttpResponseInterface
{

}