<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 9:51 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\Router;

use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;

class RouterBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        $application->getDI()->setShared('router', function () {
            $router = new \Phalcon\Mvc\Router(false);
            $router->setDefaults(['controller' => 'Vain\Phalcon\Controller\Default', 'action' => 'index']);

            return $router;
        });

        return parent::bootstrap($application);
    }
}