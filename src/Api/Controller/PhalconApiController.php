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
namespace Vain\Phalcon\Api\Controller;

use Vain\Api\Config\Provider\ApiConfigProviderInterface;
use Vain\Api\Processor\ApiProcessorInterface;
use Vain\Api\Request\Factory\ApiRequestFactoryInterface;
use Vain\Core\Encoder\EncoderInterface;
use Vain\Phalcon\Controller\AbstractController;

/**
 * Class PhalconApiController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApiController extends AbstractController
{
    /**
     * @var ApiProcessorInterface
     */
    private $processor;

    /**
     * @var ApiConfigProviderInterface
     */
    private $configProvider;

    /**
     * @var ApiRequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @param ApiProcessorInterface      $apiProcessor
     * @param ApiConfigProviderInterface $apiConfigProvider
     * @param ApiRequestFactoryInterface $apiRequestFactory
     * @param EncoderInterface           $encoder
     */
    public function initialize(
        ApiProcessorInterface $apiProcessor,
        ApiConfigProviderInterface $apiConfigProvider,
        ApiRequestFactoryInterface $apiRequestFactory,
        EncoderInterface $encoder
    ) {
        $this->processor = $apiProcessor;
        $this->configProvider = $apiConfigProvider;
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
        $apiResponse = $this->processor
            ->process(
                $this->requestFactory->createRequest($this->request),
                $this->configProvider->getConfig($this->request)
            );
        $this->response->withStatus($apiResponse->getStatus());
        foreach ($apiResponse->getHeaders() as $header => $value) {
            $this->response->withHeader($header, $value);
        }

        if ([] === $apiResponse->getData()) {
            return $this;
        }

        $this->response->getBody()->write($this->encoder->encode($apiResponse->getData()));

        return $this;
    }
}