<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:40 AM
 */

namespace Vain\Phalcon\Http\Response\Proxy;

use Vain\Http\Response\Proxy\AbstractResponseProxy;
use Vain\Http\Response\Proxy\HttpResponseProxyInterface;
use Phalcon\Http\ResponseInterface as PhalconHttpResponseInterface;

/**
 * Class AbstractResponseProxy
 * @method PhalconHttpResponseInterface getCurrentMessage
 */
class PhalconResponseProxy extends AbstractResponseProxy implements HttpResponseProxyInterface, PhalconHttpResponseInterface
{
    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null)
    {
        return $this->getCurrentMessage()->setStatusCode($code, $message);
    }

    /**
     * @inheritDoc
     */
    public function setHeader($name, $value)
    {
        return $this->getCurrentMessage()->setHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header)
    {
        return $this->getCurrentMessage()->setRawHeader($header);
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders()
    {
        return $this->getCurrentMessage()->resetHeaders();
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime)
    {
        return $this->getCurrentMessage()->setExpires($datetime);
    }

    /**
     * @inheritDoc
     */
    public function setNotModified()
    {
        return $this->getCurrentMessage()->setNotModified();
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null)
    {
        return $this->getCurrentMessage()->setContentType($contentType);
    }

    /**
     * @inheritDoc
     */
    public function redirect($location = null, $externalRedirect = false, $statusCode = 302)
    {
        return $this->getCurrentMessage()->redirect($location, $externalRedirect, $statusCode);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        return $this->getCurrentMessage()->setContent($content);
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content)
    {
        return $this->getCurrentMessage()->setJsonContent($content);
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content)
    {
        return $this->getCurrentMessage()->appendContent($content);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getCurrentMessage()->getContent();
    }

    /**
     * @inheritDoc
     */
    public function sendHeaders()
    {
        return $this->getCurrentMessage()->sendHeaders();
    }

    /**
     * @inheritDoc
     */
    public function sendCookies()
    {
        return $this->getCurrentMessage()->sendCookies();
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        return $this->getCurrentMessage()->send();
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null)
    {
        return $this->getCurrentMessage()->setFileToSend($filePath, $attachmentName);
    }
}