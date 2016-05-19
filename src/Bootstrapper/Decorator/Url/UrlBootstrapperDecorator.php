<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 9:51 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\Url;

use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;

class UrlBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        $application->getDI()->setShared('url', function () {
            $url = new \Phalcon\Mvc\Url();
            return $url;
        });


        return parent::bootstrap($application);
    }
}