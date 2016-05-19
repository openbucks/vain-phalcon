<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/17/16
 * Time: 10:33 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\Request;

use Vain\Http\Request\Factory\RequestFactoryInterface;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;

class RequestBootstrapperDecorator extends AbstractBootstrapperDecorator
{

    private $requestFactory;

    /**
     * RequestBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param RequestFactoryInterface $requestFactory
     */
    public function __construct(BootstrapperInterface $bootstrapper, RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        $request = $this->requestFactory->createRequest($_SERVER, $_GET, [], $_POST, $_FILES, $_COOKIE, 'php://input');
        $application->getDI()->setShared('request', $request);

        return parent::bootstrap($application);
    }
}