<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/18/16
 * Time: 9:21 AM
 */

namespace Vain\Phalcon\Controller;

use Phalcon\Mvc\Controller as PhalconMvcController;
use Vain\Http\Cookie\Storage\CookieStorageInterface;
use Vain\Http\Request\VainServerRequestInterface;
use Vain\Http\Response\VainResponseInterface;

/**
 * Class AbstractController
 * @property VainServerRequestInterface $request
 * @property VainResponseInterface $response
 * @property CookieStorageInterface $cookies
 * 
 */    
class AbstractController extends PhalconMvcController
{
}