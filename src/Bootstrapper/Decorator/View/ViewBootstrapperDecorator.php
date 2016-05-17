<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 9:51 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\View;

use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;
use Phalcon\DiInterface as PhalconDiInterface;

class ViewBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    private $directory;

    /**
     * ViewBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param string $directory
     */
    public function __construct(BootstrapperInterface $bootstrapper, $directory)
    {
        $this->directory = $directory;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application, PhalconDiInterface $di)
    {
        $di->set('view', function () {
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir($this->directory);

            return $view;
        });

        return parent::bootstrap($application, $di);
    }
}