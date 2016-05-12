<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/10/16
 * Time: 12:34 PM
 */

namespace Vain\Phalcon\Http\Request;

use Phalcon\Http\RequestInterface as PhalconHttpRequestInterface;
use Phalcon\Http\Request as PhalconHttpRequest;
use Vain\Http\Request\AbstractServerRequest;

class PhalconRequest extends AbstractServerRequest implements PhalconHttpRequestInterface
{
    /**
     * @inheritDoc
     */
    public function get($name = null, $filters = null, $defaultValue = null)
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        // TODO: Implement getPost() method.
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null)
    {
        // TODO: Implement getQuery() method.
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return ($this->hasQueryParam($name) || $this->hasBodyParam($name));
    }

    /**
     * @inheritDoc
     */
    public function hasPost($name)
    {
        return ($this->isPost() && $this->hasBodyParam($name));
    }

    /**
     * @inheritDoc
     */
    public function hasPut($name)
    {
        return ($this->isPut() && $this->hasBodyParam($name));
    }

    /**
     * @inheritDoc
     */
    public function hasQuery($name)
    {
        return $this->hasQueryParam($name);
    }

    /**
     * @inheritDoc
     */
    public function isAjax()
    {
        return 'XMLHttpRequest' === $this->getServer('HTTP_X_REQUESTED_WITH');
    }

    /**
     * @inheritDoc
     */
    public function isSoapRequested()
    {
        return ($this->hasServer('HTTP_SOAPACTION') || strstr('application/soap+xml', $this->getContentType()));
    }

    /**
     * @inheritDoc
     */
    public function getRawBody()
    {
        return $this->getContents();
    }

    /**
     * @inheritDoc
     */
    public function getClientAddress($trustForwardedHeader = false)
    {
        // TODO: Implement getClientAddress() method.
    }

    /**
     * @inheritDoc
     */
    public function isMethod($methods, $strict = false)
    {
        switch(true) {
            case is_string($methods):
                return ($methods === $this->getMethod());
                break;
            case is_array($methods):
                foreach ($methods as $method) {
                    if ($method === $this->getMethod()) {
                        return true;
                    }
                }
                return false;
                break;
            default:
                return false;
                break;
        }
    }

  
    /**
     * @inheritDoc
     */
    public function hasFiles($onlySuccessful = false)
    {
        // TODO: Implement hasFiles() method.
    }

    /**
     * @inheritDoc
     */
    public function getHTTPReferer()
    {
        return $this->getServer('HTTP_REFERER', '');
    }

    /**
     * @inheritDoc
     */
    public function getAcceptableContent()
    {
        return $this->getHeader('HTTP_ACCEPT');
    }

    /**
     * @inheritDoc
     */
    public function getBestAccept()
    {
        return reset($this->getAcceptableContent());
    }

    /**
     * @inheritDoc
     */
    public function getClientCharsets()
    {
        return $this->getHeader('HTTP_ACCEPT_CHARSET');
    }

    /**
     * @inheritDoc
     */
    public function getBestCharset()
    {
        return reset($this->getClientCharsets());
    }

    /**
     * @inheritDoc
     */
    public function getLanguages()
    {
        return $this->getHeader('HTTP_ACCEPT_LANGUAGE');
    }

    /**
     * @inheritDoc
     */
    public function getBestLanguage()
    {
        return reset($this->getLanguages());
    }

    /**
     * @inheritDoc
     */
    public function getBasicAuth()
    {
        if (null === ($user = $this->getUri()->getUser()) || null === ($password = $this->getUri()->getPassword())) {
            return null;
        }

        return ['username' => $user, 'password' => $password];
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth()
    {
        return null;
    }
}