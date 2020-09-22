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
namespace Vain\Phalcon\Http\Request\Proxy;

use Vain\Core\Http\Request\Proxy\AbstractRequestProxy;
use Vain\Core\Http\Request\Proxy\HttpRequestProxyInterface;
use Phalcon\Http\RequestInterface as PhalconHttpRequestInterface;
use Vain\Phalcon\Http\Request\PhalconRequest;

/**
 * Class PhalconRequestProxy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method PhalconRequest getCurrentMessage
 */
class PhalconRequestProxy extends AbstractRequestProxy implements HttpRequestProxyInterface, PhalconHttpRequestInterface
{
    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        return $this->getCurrentMessage()->getHeaders();
    }

    /**
     * @inheritDoc
     */
    public function getPost(?string $name = NULL, $filters = NULL, $defaultValue = NULL, bool $notAllowEmpty = NULL, bool $noRecursive = NULL)
    {
        return $this->getCurrentMessage()->getPost($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getPut(?string $name = NULL, $filters = NULL, $defaultValue = NULL, bool $notAllowEmpty = NULL, bool $noRecursive = NULL)
    {
        return $this->getCurrentMessage()->getPost($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getQuery(?string $name = NULL, $filters = NULL, $defaultValue = NULL, bool $notAllowEmpty = NULL, bool $noRecursive = NULL)
    {
        return $this->getCurrentMessage()->getQuery($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function has($name): bool
    {
        return $this->getCurrentMessage()->has($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPost($name): bool
    {
        return $this->getCurrentMessage()->hasPost($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPut($name): bool
    {
        return $this->getCurrentMessage()->hasPut($name);
    }

    /**
     * @inheritDoc
     */
    public function hasQuery($name): bool
    {
        return $this->getCurrentMessage()->hasQuery($name);
    }

    /**
     * @inheritDoc
     */
    public function isAjax(): bool
    {
        return $this->getCurrentMessage()->isAjax();
    }

    /**
     * @inheritDoc
     */
    public function isSoapRequested(): bool
    {
        return $this->getCurrentMessage()->isSoapRequested();
    }

    /**
     * @inheritDoc
     */
    public function getRawBody(): string
    {
        return $this->getCurrentMessage()->getRawBody();
    }

    /**
     * @inheritDoc
     */
    public function getJsonRawBody(bool $associative = NULL)
    {
        return $this->getCurrentMessage()->getJsonRawBody($mode);
    }

    /**
     * @inheritDoc
     */
    public function getClientAddress($trustForwardedHeader = false)
    {
        return $this->getCurrentMessage()->getClientAddress($trustForwardedHeader);
    }

    /**
     * @inheritDoc
     */
    public function isMethod($methods, $strict = false): bool
    {
        return $this->getCurrentMessage()->isMethod($methods, $strict);
    }

    /**
     * @inheritDoc
     */
    public function isSecure(): bool
    {
        return $this->isSecureRequest();
    }

    /**
     * @inheritDoc
     */
    public function isSoap(): bool
    {
        return $this->isSoapRequested();
    }


    /**
     * @inheritDoc
     */
    public function hasFiles($onlySuccessful = false): bool
    {
        return $this->getCurrentMessage()->hasFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function numFiles(bool $onlySuccessful = NULL): int
    {
        return $this->hasFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function getHTTPReferer(): string
    {
        return $this->getCurrentMessage()->getHTTPReferer();
    }

    /**
     * @inheritDoc
     */
    public function getAcceptableContent(): array
    {
        return $this->getCurrentMessage()->getAcceptableContent();
    }

    /**
     * @inheritDoc
     */
    public function getBestAccept(): string
    {
        return $this->getCurrentMessage()->getBestAccept();
    }

    /**
     * @inheritDoc
     */
    public function getClientCharsets(): array
    {
        return $this->getCurrentMessage()->getClientCharsets();
    }

    /**
     * @inheritDoc
     */
    public function getBestCharset(): string
    {
        return $this->getCurrentMessage()->getBestCharset();
    }

    /**
     * @inheritDoc
     */
    public function getLanguages(): array
    {
        return $this->getCurrentMessage()->getLanguages();
    }

    /**
     * @inheritDoc
     */
    public function getBestLanguage(): string
    {
        return $this->getCurrentMessage()->getBestLanguage();
    }

    /**
     * @inheritDoc
     */
    public function getBasicAuth(): ?array
    {
        return $this->getCurrentMessage()->getBasicAuth();
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth(): array
    {
        return $this->getCurrentMessage()->getDigestAuth();
    }

    /**
     * @inheritDoc
     */
    public function get(?string $name = null, $filters = null, $default = null, bool $notAllowEmpty = null, bool $noRecursive = null): mixed
    {
        return $this->getCurrentMessage()->get($name, $filters, $default);
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles(bool $onlySuccessful = NULL, bool $namedKeys = NULL): array
    {
        return $this->getCurrentMessage()->getUploadedFiles($onlySuccessFul);
    }

    /**
     * @inheritDoc
     */
    public function getPort(): int
    {
        return $this->getCurrentMessage()->getPort();
    }
}
