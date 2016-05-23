<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:40 AM
 */

namespace Vain\Phalcon\Http\Response\Proxy;

use Psr\Http\Message\StreamInterface;
use Vain\Http\Response\VainResponseInterface;

class PhalconResponseProxy implements PhalconResponseProxyInterface
{
    private $responseQueue;

    /**
     * PhalconResponseProxy constructor.
     * @param \SplQueue $responseQueue
     */
    public function __construct(\SplQueue $responseQueue)
    {
        $this->responseQueue = $responseQueue;
    }

    /**
     * @inheritDoc
     */
    public function addResponse(VainResponseInterface $vainResponse)
    {
        $this->responseQueue->enqueue($vainResponse);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function popResponse()
    {
        return $this->responseQueue->dequeue();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentResponse()
    {
        return $this->responseQueue->current();
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->getCurrentResponse()->getProtocolVersion();
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        return $this->getCurrentResponse()->withProtocolVersion($version);
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->getCurrentResponse()->getHeaders();
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        return $this->getCurrentResponse()->hasHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        return $this->getCurrentResponse()->getHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        return $this->getCurrentResponse()->getHeaderLine($name);
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        return $this->getCurrentResponse()->withHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        return $this->getCurrentResponse()->withAddedHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        return $this->getCurrentResponse()->withoutHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->getCurrentResponse()->getBody();
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        return $this->getCurrentResponse()->withBody($body);
    }

    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null)
    {
        return $this->getCurrentResponse()->setStatusCode($code, $message);
    }

    /**
     * @inheritDoc
     */
    public function setHeader($name, $value)
    {
        return $this->getCurrentResponse()->setHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header)
    {
        return $this->getCurrentResponse()->setRawHeader($header);
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders()
    {
        return $this->getCurrentResponse()->resetHeaders();
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime)
    {
        return $this->getCurrentResponse()->setExpires($datetime);
    }

    /**
     * @inheritDoc
     */
    public function setNotModified()
    {
        return $this->getCurrentResponse()->setNotModified();
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null)
    {
        return $this->getCurrentResponse()->setContentType($contentType);
    }

    /**
     * @inheritDoc
     */
    public function redirect($location = null, $externalRedirect = false, $statusCode = 302)
    {
        return $this->getCurrentResponse()->redirect($location, $externalRedirect, $statusCode);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        return $this->getCurrentResponse()->setContent($content);
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content)
    {
        return $this->getCurrentResponse()->setJsonContent($content);
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content)
    {
        return $this->getCurrentResponse()->appendContent($content);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getCurrentResponse()->getContent();
    }

    /**
     * @inheritDoc
     */
    public function sendHeaders()
    {
        return $this->getCurrentResponse()->sendHeaders();
    }

    /**
     * @inheritDoc
     */
    public function sendCookies()
    {
        return $this->getCurrentResponse()->sendCookies();
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        return $this->getCurrentResponse()->send();
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null)
    {
        return $this->getCurrentResponse()->setFileToSend($filePath, $attachmentName);
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return $this->getCurrentResponse()->getStatusCode();
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        return $this->getCurrentResponse()->withStatus($code, $reasonPhrase);
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase()
    {
        return $this->getCurrentResponse()->getReasonPhrase();
    }
}