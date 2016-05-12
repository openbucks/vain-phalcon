<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/10/16
 * Time: 12:42 PM
 */

namespace Vain\Phalcon\Http\Response;

use Phalcon\Http\ResponseInterface as PhalconHttpResponseInterface;
use Vain\Http\Response\AbstractResponse;

class PhalconResponse extends AbstractResponse implements PhalconHttpResponseInterface
{
    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null)
    {
        return $this->withStatus($code, $message);
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
        list ($headerName, $headerValue) = explode(':', $header);
        return $this->addHeader($headerName, $headerValue);
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime)
    {
        $cloned = clone $datetime;
        $cloned->setTimezone(new \DateTimeZone("UTC"));

        return $this->addHeader('Expires', $datetime->format("D, d M Y H:i:s") . " GMT");
    }

    /**
     * @inheritDoc
     */
    public function setNotModified()
    {
        return $this->withStatus(304, 'Not modified');
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null)
    {
        if (null === $charset) {
            return $this->addHeader('Content-Type', $contentType);
        }

        return $this->addHeader('Content-Type', sprintf('%s";charset=%s"', $contentType, $charset));
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
        $this->getBody()->write($content);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content)
    {
        if (false === ($encoded = json_encode($content))) {
            
        }
        return $this->setContent($encoded);
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content)
    {
        $this->getBody()->write($content);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getBody()->getContents();
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