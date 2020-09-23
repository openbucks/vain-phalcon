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
namespace Vain\Phalcon\Http\Response;

use Vain\Core\Http\Response\AbstractResponse;
use Vain\Phalcon\Exception\BadRedirectCodeException;
use Vain\Phalcon\Exception\JsonErrorException;
use Phalcon\Http\ResponseInterface as PhalconHttpResponseInterface;

/**
 * Class PhalconResponse
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconResponse extends AbstractResponse implements PhalconHttpResponseInterface
{
    /**
     * @inheritDoc
     */
    public function setStatusCode($code, $message = null): PhalconHttpResponseInterface
    {
        return $this->withStatus($code, $message);
    }

    /**
     * @inheritDoc
     */
    public function setHeader($name, $value): PhalconHttpResponseInterface
    {
        $this->getHeaderStorage()->createHeader($name, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRawHeader($header): PhalconHttpResponseInterface
    {
        list ($headerName, $headerValue) = explode(':', $header);
        $this->getHeaderStorage()->createHeader($headerName, $headerValue);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentLength($contentLength):PhalconHttpResponseInterface
    {
        return $this->withHeader(self::HEADER_CONTENT_LENGTH, $contentLength);
    }

    /**
     * @inheritDoc
     */
    public function setExpires(\DateTime $datetime): PhalconHttpResponseInterface
    {
        $cloned = clone $datetime;
        $cloned->setTimezone(new \DateTimeZone("UTC"));
        $this->getHeaderStorage()->createHeader(self::HEADER_EXPIRES, $datetime->format("D, d M Y H:i:s") . " GMT");

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNotModified(): PhalconHttpResponseInterface
    {
        return $this->withStatus(304, 'Not modified');
    }

    /**
     * @inheritDoc
     */
    public function setContentType($contentType, $charset = null): PhalconHttpResponseInterface
    {
        if (null === $charset) {
            $this->getHeaderStorage()->createHeader(self::HEADER_CONTENT_TYPE, $contentType);
        } else {
            $this->getHeaderStorage()->createHeader(
                self::HEADER_CONTENT_TYPE,
                sprintf('%s";charset=%s"', $contentType, $charset)
            );
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function redirect($location = null, bool $externalRedirect = null, int $statusCode = 302): PhalconHttpResponseInterface
    {
        if ($statusCode < 300 || $statusCode > 308) {
            throw new BadRedirectCodeException($this, $statusCode);
        }

        return $this
            ->withStatus($statusCode)
            ->withHeader(self::HEADER_LOCATION, $location);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content): PhalconHttpResponseInterface
    {
        $this->getBody()->write($content);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setJsonContent($content): PhalconHttpResponseInterface
    {
        if (false === ($encoded = json_encode($content))) {
            throw new JsonErrorException($this, $content);
        }

        return $this->setContent($encoded);
    }

    /**
     * @inheritDoc
     */
    public function appendContent($content): PhalconHttpResponseInterface
    {
        $this->getBody()->write($content);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send(): PhalconHttpResponseInterface
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isSent(): bool
    {
        throw new UnsupportedResponseCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function sendHeaders(): PhalconHttpResponseInterface
    {
        return $this;
        //throw new UnsupportedResponseCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function sendCookies(): PhalconHttpResponseInterface
    {
        return $this;
        //throw new UnsupportedResponseCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->getBody()->getContents();
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders(): PhalconHttpResponseInterface
    {
        $copy = clone $this;
        $copy->getHeaderStorage()->resetHeaders();

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function setFileToSend($filePath, $attachmentName = null): PhalconHttpResponseInterface
    {
        $this->getHeaderStorage()->resetHeaders();

        $basePath = $attachmentName;

        if ('string' !== gettype($attachmentName)) {
            $basePath = basename($attachmentName);
        }

        $this->getBody()->write(readfile($filePath));

        return $this
            ->setHeader(self::HEADER_CONTENT_DESCRIPTION, 'File Transfer')
            ->setHeader(self::HEADER_CONTENT_TYPE, 'application/octet-stream')
            ->setHeader(self::HEADER_CONTENT_DISPOSITION, sprintf('attachment; filename=%s', $basePath))
            ->setHeader(self::HEADER_CONTENT_TRANSFER_ENCODING, 'binary');
    }
}
