<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 9:58 AM
 */

namespace Vain\Phalcon\Controller;

use Phalcon\Mvc\Controller as PhalconMvcController;

class DefaultController extends PhalconMvcController
{
    
    public function indexAction()
    {
        echo 'Hello World';
    }
}