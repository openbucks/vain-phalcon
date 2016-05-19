<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/19/16
 * Time: 9:21 AM
 */

namespace Vain\Phalcon\Application;

use Phalcon\Mvc\Application;
use Vain\Http\Response\Factory\ResponseFactoryInterface;

class PhalconApplication extends Application
{
    private $responseFactory;

    /**
     * PhalconApplication constructor.
     * @param ResponseFactoryInterface $responseFactory
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function __construct(ResponseFactoryInterface $responseFactory, \Phalcon\DiInterface $dependencyInjector)
    {
        $this->responseFactory = $responseFactory;
        parent::__construct($dependencyInjector);
    }

    /**
     * @inheritdoc
     */
    public function handle($uri = null)
    {
        try {
            return parent::handle($uri);
        } catch (\Exception $e) {
            return $this->responseFactory
                    ->createResponse('php://temp')
                    ->withStatus($e->getCode(), $e->getMessage());
        }
    }
}