<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
namespace Vain\Phalcon\Http\Response\Proxy;

use Phalcon\Http\Response\HeadersInterface as PhalconHeadersInterface;
use Vain\Core\Http\Response\Proxy\AbstractResponseProxy;
use Vain\Core\Http\Response\Proxy\HttpResponseProxyInterface;
use Phalcon\Http\ResponseInterface as PhalconHttpResponseInterface;
use Vain\Phalcon\Http\Response\PhalconResponse;

/**
 * Class PhalconResponseProxy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconResponse getCurrentMessage
 * @method PhalconResponse popResponse
 */
class PhalconResponseProxy extends AbstractResponseProxy implements
    HttpResponseProxyInterface,
    PhalconHttpResponseInterface
{
    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setStatusCode($code, $message);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setHeader($name, $value): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setHeader($name, $value);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setRawHeader($header);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders(): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->resetHeaders();
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): PhalconHeadersInterface
    {
        return $this->getCurrentMessage()->getHeaders();
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setExpires($datetime);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentLength($contentLength): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setContentLength($contentLength);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNotModified(): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setNotModified();
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setContentType($contentType);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function redirect($location = null, $externalRedirect = false, $statusCode = 302): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->redirect($location, $externalRedirect, $statusCode);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContent($content): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setContent($content);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setJsonContent($content);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->appendContent($content);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->getCurrentMessage()->getContent();
    }

    /**
     * @inheritDoc
     */
    public function sendHeaders(): PhalconHttpResponseInterface
    {
        return $this->getCurrentMessage()->sendHeaders();
    }

    /**
     * @inheritDoc
     */
    public function sendCookies(): PhalconHttpResponseInterface
    {
        return $this->getCurrentMessage()->sendCookies();
    }

    /**
     * @inheritDoc
     */
    public function send(): PhalconHttpResponseInterface
    {
        return $this->getCurrentMessage()->send();
    }

    /**
     * @inheritDoc
     */
    public function isSent(): bool
    {
        return $this->getCurrentMessage()->isSent();
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null): PhalconHttpResponseInterface
    {
        $response = $this->popResponse()->setFileToSend($filePath, $attachmentName);
        $this->addResponse($response);

        return $this;
    }
}
