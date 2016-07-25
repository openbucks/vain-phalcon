<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-phalcon
 */
namespace Vain\Phalcon\Controller;

use Vain\Api\Processor\ApiProcessorInterface;
use Vain\Api\Request\Factory\ApiRequestFactoryInterface;
use Vain\Core\Encoder\EncoderInterface;

/**
 * Class AbstractApiController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractApiController extends AbstractController
{
    /**
     * @var ApiProcessorInterface
     */
    private $processor;

    /**
     * @var ApiRequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @param ApiProcessorInterface $apiProcessor
     * @param ApiRequestFactoryInterface $apiRequestFactory
     * @param EncoderInterface $encoder
     */
    public function initialize(
        ApiProcessorInterface $apiProcessor,
        ApiRequestFactoryInterface $apiRequestFactory,
        EncoderInterface $encoder
    ) {
        $this->processor = $apiProcessor;
        $this->requestFactory = $apiRequestFactory;
        $this->encoder = $encoder;
    }

    /**
     * @return ApiProcessorInterface
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * @return ApiRequestFactoryInterface
     */
    public function getRequestFactory()
    {
        return $this->requestFactory;
    }

    /**
     * @return EncoderInterface
     */
    public function getEncoder()
    {
        return $this->encoder;
    }

    /**
     * @inheritDoc
     */
    public function indexAction()
    {
        $apiResponse = $this->processor->process($this->requestFactory->createRequest($this->request));

        $this->response->withStatus($apiResponse->getStatus());
        foreach ($apiResponse->getHeaders() as $header => $value) {
            $this->response->withHeader($header, $value);
        }
        $this->response->getBody()->write($this->encoder->encode($apiResponse->getData()));
    }
}