<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/19/16
 * Time: 12:24 PM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\Application;

use Vain\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Phalcon\Application\PhalconApplication;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;

class ApplicationBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    
    private $responseFactory;
    
    /**
     * ApplicationBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(BootstrapperInterface $bootstrapper, ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        if ($application instanceof PhalconApplication) {
            return $application->setResponseFactory($this->responseFactory);
        }
        
        return parent::bootstrap($application);
    }
}