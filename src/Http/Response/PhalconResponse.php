<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/10/16
 * Time: 12:42 PM
 */

namespace Vain\Phalcon\Http\Response;

use Phalcon\Http\ResponseInterface as PhalconHttpResponseInterface;
use Vain\Http\Header\Storage\HeaderStorageInterface;
use Vain\Http\Response\AbstractResponse;
use Vain\Http\Stream\VainStreamInterface;
use Vain\Phalcon\Exception\JsonErrorException;

class PhalconResponse extends AbstractResponse implements PhalconHttpResponseInterface
{
    private $cookies;

    /**
     * PhalconResponse constructor.
     * @param array $cookies
     * @param \Vain\Http\Stream\VainStreamInterface $code
     * @param VainStreamInterface $stream
     * @param HeaderStorageInterface $headerStorage
     */
    public function __construct(array $cookies = [], $code, VainStreamInterface $stream, HeaderStorageInterface $headerStorage)
    {
        $this->cookies = $cookies;
        parent::__construct($code, $stream, $headerStorage);
    }

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
        $this->getHeaderStorage()->createHeader($name, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header)
    {
        list ($headerName, $headerValue) = explode(':', $header);
        $this->getHeaderStorage()->createHeader($headerName, $headerValue);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime)
    {
        $cloned = clone $datetime;
        $cloned->setTimezone(new \DateTimeZone("UTC"));
        $this->getHeaderStorage()->createHeader('Expires', $datetime->format("D, d M Y H:i:s") . " GMT");

        return $this;
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
            $this->getHeaderStorage()->createHeader('Content-Type', $contentType);
        } else {
            $this->getHeaderStorage()->createHeader('Content-Type', sprintf('%s";charset=%s"', $contentType, $charset));
        }

        return $this;
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
            throw new JsonErrorException($this, $content);
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
     * @return $this
     */
    public function sendHeaders()
    {
        if (headers_sent()) {
            return $this;
        }

        foreach ($this->getHeaderStorage()->getHeaders() as $header) {
            $header->send();
        }

        header(sprintf('HTTP/%s %s %s', $this->getProtocolVersion(), $this->getStatusCode(), $this->getReasonPhrase()), true, $this->getStatusCode());

        return $this;
    }

    /**
     * @return $this
     */
    public function sendCookies()
    {
        foreach ($this->cookies as $cookie) {
            $cookie->send();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function sendBody()
    {
        echo $this->getBody();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        $this
            ->sendHeaders()
            ->sendCookies()
            ->sendBody();

        switch (true) {
            case function_exists('fastcgi_finish_request'):
                fastcgi_finish_request();
                break;
            case 'cli' !== PHP_SAPI:
                $this->closeBuffers();
                break;
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function closeBuffers()
    {
        $status = ob_get_status(true);
        $level = count($status);
        $flags = PHP_OUTPUT_HANDLER_REMOVABLE | PHP_OUTPUT_HANDLER_FLUSHABLE;
        while ($level-- > 0 && ($s = $status[$level]) && (!isset($s['del']) ? !isset($s['flags']) || $flags === ($s['flags'] & $flags) : $s['del'])) {
            ob_end_flush();
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders()
    {
        $copy = clone $this;
        $copy->getHeaderStorage()->resetHeaders();

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null)
    {
        $this->getHeaderStorage()->resetHeaders();

        $basePath = $attachmentName;

        if ('string' === gettype($attachmentName)) {
            $basePath = basename($attachmentName);
        }

        $this->getBody()->write(readfile($filePath));
        
        return $this->setHeader('Content-Description', 'File Transfer')
			->setHeader('Content-Type', 'application/octet-stream')
			->setHeader('Content-Disposition', sprintf('attachment; filename=%s', $basePath))
			->setHeader('Content-Transfer-Encoding', 'binary');
    }
}