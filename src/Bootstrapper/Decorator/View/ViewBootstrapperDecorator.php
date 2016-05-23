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
use \Phalcon\Mvc\View as PhalconMvcView;

class ViewBootstrapperDecorator extends AbstractBootstrapperDecorator
{

    private $view;

    private $directory;

    /**
     * ViewBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param PhalconMvcView $view
     * @param string $directory
     */
    public function __construct(BootstrapperInterface $bootstrapper, PhalconMvcView $view, $directory)
    {
        $this->view = $view;
        $this->directory = $directory;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        $this->view->setViewsDir($this->directory);

        return parent::bootstrap($application);
    }
}