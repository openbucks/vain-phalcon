<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/10/16
 * Time: 12:42 PM
 */

namespace Vain\Phalcon\Http;

use Phalcon\Http\ResponseInterface as PhalconHttpResponseInterface;
use Vain\Http\Response\AbstractResponse;

class PhalconResponse extends AbstractResponse implements PhalconHttpResponseInterface
{
    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null)
    {
        // TODO: Implement setStatusCode() method.
    }

    /**
     * @inheritDoc
     */
    public function setHeader($name, $value)
    {
        return $this->addHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header)
    {
        // TODO: Implement setRawHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders()
    {
        // TODO: Implement resetHeaders() method.
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime)
    {
        // TODO: Implement setExpires() method.
    }

    /**
     * @inheritDoc
     */
    public function setNotModified()
    {
        // TODO: Implement setNotModified() method.
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null)
    {
        // TODO: Implement setContentType() method.
    }

    /**
     * @inheritDoc
     */
    public function redirect($location = null, $externalRedirect = false, $statusCode = 302)
    {
        // TODO: Implement redirect() method.
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        // TODO: Implement setContent() method.
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content)
    {
        // TODO: Implement setJsonContent() method.
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content)
    {
        // TODO: Implement appendContent() method.
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        // TODO: Implement getContent() method.
    }

    /**
     * @inheritDoc
     */
    public function sendHeaders()
    {
        // TODO: Implement sendHeaders() method.
    }

    /**
     * @inheritDoc
     */
    public function sendCookies()
    {
        // TODO: Implement sendCookies() method.
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        // TODO: Implement send() method.
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null)
    {
        // TODO: Implement setFileToSend() method.
    }
}