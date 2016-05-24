<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/23/16
 * Time: 10:16 AM
 */

namespace Vain\Phalcon\Http\Request\Proxy;

use Vain\Http\Request\Proxy\AbstractRequestProxy;
use Vain\Http\Request\Proxy\HttpRequestProxyInterface;
use Phalcon\Http\RequestInterface as PhalconHttpRequestInterface;

/**
 * @method PhalconHttpRequestInterface getCurrentMessage
 */
class PhalconRequestProxy extends AbstractRequestProxy implements HttpRequestProxyInterface, PhalconHttpRequestInterface
{
    /**
     * @inheritDoc
     */
    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getCurrentMessage()->getPost($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getCurrentMessage()->getQuery($name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return $this->getCurrentMessage()->has($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPost($name)
    {
        return $this->getCurrentMessage()->hasPost($name);
    }

    /**
     * @inheritDoc
     */
    public function hasPut($name)
    {
        return $this->getCurrentMessage()->hasPut($name);
    }

    /**
     * @inheritDoc
     */
    public function hasQuery($name)
    {
        return $this->getCurrentMessage()->hasQuery($name);
    }

    /**
     * @inheritDoc
     */
    public function isAjax()
    {
        return $this->getCurrentMessage()->isAjax();
    }

    /**
     * @inheritDoc
     */
    public function isSoapRequested()
    {
        return $this->getCurrentMessage()->isSoapRequested();
    }

    /**
     * @inheritDoc
     */
    public function getRawBody()
    {
        return $this->getCurrentMessage()->getRawBody();
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
    public function isMethod($methods, $strict = false)
    {
        return $this->getCurrentMessage()->isMethod($methods, $strict);
    }

    /**
     * @inheritDoc
     */
    public function hasFiles($onlySuccessful = false)
    {
        return $this->getCurrentMessage()->hasFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function getHTTPReferer()
    {
        return $this->getCurrentMessage()->getHTTPReferer();
    }

    /**
     * @inheritDoc
     */
    public function getAcceptableContent()
    {
        return $this->getCurrentMessage()->getAcceptableContent();
    }

    /**
     * @inheritDoc
     */
    public function getBestAccept()
    {
        return $this->getCurrentMessage()->getBestAccept();
    }

    /**
     * @inheritDoc
     */
    public function getClientCharsets()
    {
        return $this->getCurrentMessage()->getClientCharsets();
    }

    /**
     * @inheritDoc
     */
    public function getBestCharset()
    {
        return $this->getCurrentMessage()->getBestCharset();
    }

    /**
     * @inheritDoc
     */
    public function getLanguages()
    {
        return $this->getCurrentMessage()->getLanguages();
    }

    /**
     * @inheritDoc
     */
    public function getBestLanguage()
    {
        return $this->getCurrentMessage()->getBestLanguage();
    }

    /**
     * @inheritDoc
     */
    public function getBasicAuth()
    {
        return $this->getCurrentMessage()->getBasicAuth();
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth()
    {
        return $this->getCurrentMessage()->getDigestAuth();
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles($onlySuccessful = false)
    {
        return $this->getCurrentMessage()->getUploadedFiles($onlySuccessful);
    }

    /**
     * @inheritDoc
     */
    public function getServer($name, $default = null)
    {
        return $this->getCurrentMessage()->getServer($name);
    }

    /**
     * @inheritDoc
     */
    public function hasServer($name)
    {
        return $this->getCurrentMessage()->hasServer($name);
    }

    /**
     * @inheritDoc
     */
    public function get($name = null, $filters = null, $default = null)
    {
        return $this->getCurrentMessage()->get($name, $filters, $default);
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent()
    {
        return $this->getCurrentMessage()->getUserAgent();
    }

    /**
     * @inheritDoc
     */
    public function getServerAddress()
    {
        return $this->getCurrentMessage()->getServerAddress();
    }

    /**
     * @inheritDoc
     */
    public function getServerName()
    {
        return $this->getCurrentMessage()->getServerName();
    }

    /**
     * @inheritDoc
     */
    public function getHttpHost()
    {
        return $this->getCurrentMessage()->getHttpHost();
    }

    /**
     * @inheritDoc
     */
    public function isPost()
    {
        return $this->getCurrentMessage()->isPost();
    }

    /**
     * @inheritDoc
     */
    public function isGet()
    {
        return $this->getCurrentMessage()->isGet();
    }

    /**
     * @inheritDoc
     */
    public function isPut()
    {
        return $this->getCurrentMessage()->isPut();
    }

    /**
     * @inheritDoc
     */
    public function getScheme()
    {
        return $this->getCurrentMessage()->getScheme();
    }

    /**
     * @inheritDoc
     */
    public function isHead()
    {
        return $this->getCurrentMessage()->isHead();
    }

    /**
     * @inheritDoc
     */
    public function isDelete()
    {
        return $this->getCurrentMessage()->isDelete();
    }

    /**
     * @inheritDoc
     */
    public function isOptions()
    {
        return $this->getCurrentMessage()->isOptions();
    }

    /**
     * @inheritDoc
     */
    public function isSecureRequest()
    {
        return $this->getCurrentMessage()->isSecureRequest();
    }
}