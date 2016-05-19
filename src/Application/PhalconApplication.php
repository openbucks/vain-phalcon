<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/19/16
 * Time: 9:21 AM
 */

namespace Vain\Phalcon\Application;

use \Phalcon\DiInterface as PhalconDiInterface;
use Phalcon\Mvc\Application as PhalconMvcApplication;
use Vain\Http\Response\Factory\ResponseFactoryInterface;

class PhalconApplication extends PhalconMvcApplication
{
    /**
     * PhalconApplication constructor.
     * @param ResponseFactoryInterface $responseFactory
     * @param PhalconDiInterface $dependencyInjector
     */
    public function __construct(ResponseFactoryInterface $responseFactory, PhalconDiInterface $dependencyInjector)
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