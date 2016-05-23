<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:16 AM
 */

namespace Vain\Phalcon\Http\Request\Proxy;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Vain\Http\Request\VainServerRequestInterface;
use Phalcon\Http\RequestInterface as PhalconHttpRequestInterface;

class PhalconRequestProxy implements PhalconRequestProxyInterface,  VainServerRequestInterface, PhalconHttpRequestInterface
{
    private $requestQueue;

    /**
     * PhalconRequestProxy constructor.
     */
    public function __construct()
    {
        $this->requestQueue = new \SplStack();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentRequest()
    {
        return $this->requestQueue->current();
    }

    /**
     * @inheritDoc
     */
    public function addRequest(VainServerRequestInterface $phalconRequest)
    {
        $this->requestQueue->push($phalconRequest);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function popRequest()
    {
        return $this->requestQueue->pop();
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->getCurrentRequest()->getProtocolVersion();
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        return $this->getCurrentRequest()->withProtocolVersion($version);
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->getCurrentRequest()->getHeaders();
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        return $this->getCurrentRequest()->hasHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        return $this->getCurrentRequest()->getHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        return $this->getCurrentRequest()->getHeaderLine($name);
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        return $this->getCurrentRequest()->withHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        return $this->getCurrentRequest()->withAddedHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        return $this->getCurrentRequest()->withoutHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->getCurrentRequest()->getBody();
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        return $this->getCurrentRequest()->withBody($body);
    }

    /**
     * @inheritDoc
     */
    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getCurrentRequest()->getPost($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getCurrentRequest()->getQuery($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return $this->getCurrentRequest()->has($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPost($name)
    {
        return $this->getCurrentRequest()->hasPost($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPut($name)
    {
        return $this->getCurrentRequest()->hasPut($name);
    }

    /**
     * @inheritDoc
     */
    public function hasQuery($name)
    {
        return $this->getCurrentRequest()->hasQuery($name);
    }

    /**
     * @inheritDoc
     */
    public function isAjax()
    {
        return $this->getCurrentRequest()->isAjax();
    }

    /**
     * @inheritDoc
     */
    public function isSoapRequested()
    {
        return $this->getCurrentRequest()->isSoapRequested();
    }

    /**
     * @inheritDoc
     */
    public function getRawBody()
    {
        return $this->getCurrentRequest()->getRawBody();
    }

    /**
     * @inheritDoc
     */
    public function getClientAddress($trustForwardedHeader = false)
    {
        return $this->getCurrentRequest()->getClientAddress($trustForwardedHeader);
    }

    /**
     * @inheritDoc
     */
    public function isMethod($methods, $strict = false)
    {
        return $this->getCurrentRequest()->isMethod($methods, $strict);
    }

    /**
     * @inheritDoc
     */
    public function hasFiles($onlySuccessful = false)
    {
        return $this->getCurrentRequest()->hasFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function getHTTPReferer()
    {
        return $this->getCurrentRequest()->getHTTPReferer();
    }

    /**
     * @inheritDoc
     */
    public function getAcceptableContent()
    {
        return $this->getCurrentRequest()->getAcceptableContent();
    }

    /**
     * @inheritDoc
     */
    public function getBestAccept()
    {
        return $this->getCurrentRequest()->getBestAccept();
    }

    /**
     * @inheritDoc
     */
    public function getClientCharsets()
    {
        return $this->getCurrentRequest()->getClientCharsets();
    }

    /**
     * @inheritDoc
     */
    public function getBestCharset()
    {
        return $this->getCurrentRequest()->getBestCharset();
    }

    /**
     * @inheritDoc
     */
    public function getLanguages()
    {
        return $this->getCurrentRequest()->getLanguages();
    }

    /**
     * @inheritDoc
     */
    public function getBestLanguage()
    {
        return $this->getCurrentRequest()->getBestLanguage();
    }

    /**
     * @inheritDoc
     */
    public function getBasicAuth()
    {
        return $this->getCurrentRequest()->getBasicAuth();
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth()
    {
        return $this->getCurrentRequest()->getDigestAuth();
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget()
    {
        return $this->getCurrentRequest()->getRequestTarget();
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget)
    {
        return $this->getCurrentRequest()->withRequestTarget($requestTarget);
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return $this->getCurrentRequest()->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method)
    {
        return $this->getCurrentRequest()->withMethod($method);
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return $this->getCurrentRequest()->getUri();
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        return $this->getCurrentRequest()->withUri($uri, $preserveHost);
    }

    /**
     * @inheritDoc
     */
    public function getServerParams()
    {
        return $this->getCurrentRequest()->getServerParams();
    }

    /**
     * @inheritDoc
     */
    public function getCookieParams()
    {
        return $this->getCurrentRequest()->getCookieParams();
    }

    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies)
    {
        return $this->getCurrentRequest()->withCookieParams($cookies);
    }

    /**
     * @inheritDoc
     */
    public function getQueryParams()
    {
        return $this->getCurrentRequest()->getQueryParams();
    }

    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query)
    {
        return $this->getCurrentRequest()->withQueryParams($query);
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles($onlySuccessful = false)
    {
        return $this->getCurrentRequest()->getUploadedFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function withUploadedFiles(array $uploadedFiles)
    {
        return $this->getCurrentRequest()->withUploadedFiles($uploadedFiles);
    }

    /**
     * @inheritDoc
     */
    public function getParsedBody()
    {
        return $this->getCurrentRequest()->getParsedBody();
    }

    /**
     * @inheritDoc
     */
    public function withParsedBody($data)
    {
        return $this->getCurrentRequest()->withParsedBody($data);
    }

    /**
     * @inheritDoc
     */
    public function getAttributes()
    {
        return $this->getCurrentRequest()->getAttributes();
    }

    /**
     * @inheritDoc
     */
    public function getAttribute($name, $default = null)
    {
        return $this->getCurrentRequest()->getAttribute($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value)
    {
        return $this->getCurrentRequest()->withAttribute($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function withoutAttribute($name)
    {
        return $this->getCurrentRequest()->withoutAttribute($name);
    }

    /**
     * @inheritDoc
     */
    public function getContents()
    {
        return $this->getCurrentRequest()->getContents();
    }

    /**
     * @inheritDoc
     */
    public function getServer($name, $default = null)
    {
        return $this->getCurrentRequest()->getServer($name);
    }

    /**
     * @inheritDoc
     */
    public function hasServer($name)
    {
        return $this->getCurrentRequest()->hasServer($name);
    }

    /**
     * @inheritDoc
     */
    public function hasQueryParam($name)
    {
        return $this->getCurrentRequest()->hasQueryParam($name);
    }

    /**
     * @inheritDoc
     */
    public function hasBodyParam($name)
    {
        return $this->getCurrentRequest()->hasBodyParam($name);
    }

    /**
     * @inheritDoc
     */
    public function get($name = null, $filters = null, $default = null)
    {
        return $this->getCurrentRequest()->get($name, $filters, $default);
    }

    /**
     * @inheritDoc
     */
    public function post($name, $default = null)
    {
        return $this->getCurrentRequest()->post($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function getContentType()
    {
        return $this->getCurrentRequest()->getContentType();
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent()
    {
        return $this->getCurrentRequest()->getUserAgent();
    }

    /**
     * @inheritDoc
     */
    public function getServerAddress()
    {
        return $this->getCurrentRequest()->getServerAddress();
    }

    /**
     * @inheritDoc
     */
    public function getServerName()
    {
        return $this->getCurrentRequest()->getServerName();
    }

    /**
     * @inheritDoc
     */
    public function getHttpHost()
    {
        return $this->getCurrentRequest()->getHttpHost();
    }

    /**
     * @inheritDoc
     */
    public function isPost()
    {
        return $this->getCurrentRequest()->isPost();
    }

    /**
     * @inheritDoc
     */
    public function isGet()
    {
        return $this->getCurrentRequest()->isGet();
    }

    /**
     * @inheritDoc
     */
    public function isPut()
    {
        return $this->getCurrentRequest()->isPut();
    }

    /**
     * @inheritDoc
     */
    public function getScheme()
    {
        return $this->getCurrentRequest()->getScheme();
    }

    /**
     * @inheritDoc
     */
    public function isHead()
    {
        return $this->getCurrentRequest()->isHead();
    }

    /**
     * @inheritDoc
     */
    public function isDelete()
    {
        return $this->getCurrentRequest()->isDelete();
    }

    /**
     * @inheritDoc
     */
    public function isOptions()
    {
        return $this->getCurrentRequest()->isOptions();
    }

    /**
     * @inheritDoc
     */
    public function isSecureRequest()
    {
        return $this->getCurrentRequest()->isSecureRequest();
    }
}