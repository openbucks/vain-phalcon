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

use Vain\Core\Api\Command\ApiCommandInterface;
use Vain\Core\Api\Config\Provider\ApiConfigProviderInterface;
use Vain\Core\Api\Request\Validator\ApiValidatorInterface;
use Vain\Core\Encoder\EncoderInterface;
use Vain\Core\Http\Response\VainResponseInterface;
use Vain\Phalcon\Controller\AbstractController;

/**
 * Class PhalconApiController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconApiController extends AbstractController
{
    /**
     * @var ApiCommandInterface
     */
    private $command;

    /**
     * @var ApiValidatorInterface
     */
    private $validator;

    /**
     * @var ApiConfigProviderInterface
     */
    private $configProvider;

    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @param ApiCommandInterface        $apiCommand
     * @param ApiValidatorInterface      $apiValidator
     * @param ApiConfigProviderInterface $apiConfigProvider
     * @param EncoderInterface           $encoder
     */
    public function initialize(
        ApiCommandInterface $apiCommand,
        ApiValidatorInterface $apiValidator,
        ApiConfigProviderInterface $apiConfigProvider,
        EncoderInterface $encoder
    ) {
        $this->command = $apiCommand;
        $this->validator = $apiValidator;
        $this->configProvider = $apiConfigProvider;
        $this->encoder = $encoder;
    }

    /**
     * @return ApiCommandInterface
     */
    public function getCommand(): ApiCommandInterface
    {
        return $this->command;
    }

    /**
     * @return ApiValidatorInterface
     */
    public function getValidator(): ApiValidatorInterface
    {
        return $this->validator;
    }

    /**
     * @return ApiConfigProviderInterface
     */
    public function getConfigProvider(): ApiConfigProviderInterface
    {
        return $this->configProvider;
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
        $apiConfig = $this->configProvider->getConfig($this->request->getUri()->getPath());
        $validatorResult = $this->validator->validate($this->request, $apiConfig);
        if (false === $validatorResult->isSuccessful()) {
            $this->response
                ->withStatus(422)
                ->withContentType(VainResponseInterface::CONTENT_TYPE_APPLICATION_JSON)
                ->getBody()
                ->write($this->encoder->encode($validatorResult->toDisplay()));

            return $this;
        }
        $apiResponse = $this->command->execute($validatorResult->getRequest(), $apiConfig);

        $this->response
            ->withStatus($apiResponse->getStatus(), $apiResponse->getShortMessage())
            ->withContentType(VainResponseInterface::CONTENT_TYPE_APPLICATION_JSON)
            ->getBody()
            ->write($this->encoder->encode($apiResponse->getData()));

        foreach ($apiResponse->getHeaders() as $header => $value) {
            $this->response->withHeader($header, $value);
        }

        return $this;
    }
}
