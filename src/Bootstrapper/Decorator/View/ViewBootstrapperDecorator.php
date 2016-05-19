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
    public function bootstrap(PhalconDiInjectable $application)
    {
        $directory = $this->directory;
        $application->getDI()->setShared('view', function () use($directory) {
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir($directory);

            return $view;
        });

        return parent::bootstrap($application);
    }
}