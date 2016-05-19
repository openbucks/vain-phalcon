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
    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * PhalconApplication constructor.
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function __construct(\Phalcon\DiInterface $dependencyInjector)
    {
        parent::__construct($dependencyInjector);
    }

    /**
     * @param ResponseFactoryInterface $responseFactory
     *
     * @return PhalconApplication
     */
    public function setResponseFactory(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;

        return $this;
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