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
namespace Vain\Phalcon\Http\Request;

use Phalcon\FilterInterface as PhalconFilterInterface;
use Vain\Http\Cookie\Storage\CookieStorageInterface;
use Vain\Http\File\VainFileInterface;
use Vain\Http\Header\Storage\HeaderStorageInterface;
use Vain\Http\Request\AbstractServerRequest;
use Vain\Http\Stream\VainStreamInterface;
use Phalcon\Http\RequestInterface as PhalconHttpRequestInterface;
use Vain\Http\Uri\VainUriInterface;

/**
 * Class PhalconRequest
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconRequest extends AbstractServerRequest implements PhalconHttpRequestInterface
{
    private $filter;

    /**
     * PhalconRequest constructor.
     * @param PhalconFilterInterface $filter
     * @param array $serverParams
     * @param array $uploadedFiles
     * @param array $queryParams
     * @param array $attributes
     * @param string $parsedBody
     * @param string $protocol
     * @param VainUriInterface $method
     * @param VainUriInterface $uri
     * @param VainStreamInterface $stream
     * @param CookieStorageInterface $cookieStorage
     * @param HeaderStorageInterface $headerStorage
     */
    public function __construct(PhalconFilterInterface $filter, array $serverParams, $uploadedFiles, array $queryParams, array $attributes, $parsedBody, $protocol, $method, VainUriInterface $uri, VainStreamInterface $stream, CookieStorageInterface $cookieStorage, HeaderStorageInterface $headerStorage)
    {
        $this->filter = $filter;
        parent::__construct($serverParams, $uploadedFiles, $queryParams, $attributes, $parsedBody, $protocol, $method, $uri, $stream, $cookieStorage, $headerStorage);
    }

    /**
     * @inheritDoc
     */
    public function get($name = null, $filters = null, $defaultValue = null)
    {
        if ($this->isGet()) {
            return $this->getQuery($name, $filters, $defaultValue);
        }

        return $this->getPost($name, $filters, $defaultValue);
    }

    /**
     * @param array $data
     * @param string $name
     * @param array $filters
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    protected function getRequestValue(array $data, $name, $filters, $defaultValue)
    {
        if (null === $name) {
            return $data;
        }

        if (false === array_key_exists($name, $data)) {
            return $defaultValue;
        }

        $value = $data[$name];

        if (null === $filters) {
            return $value;

        }

        return $this->filter->sanitize($value, $filters);
    }

    /**
     * @inheritDoc
     */
    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getRequestValue($this->getParsedBody(), $name, $filters, $defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null)
    {
        return $this->getRequestValue($this->getQueryParams(), $name, $filters, $defaultValue);
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
        return $this->getServer('REMOTE_ADDR');
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
        $count = 0;
        foreach ($this->getUploadedFiles() as $file) {
            if (UPLOAD_ERR_OK !== $file->getError()) {
                continue;
            }
            $count++;
        }

        return $count;
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
     * @param bool $onlySuccessful
     *
     * @return VainFileInterface[]
     */
    public function getUploadedFiles($onlySuccessful = null)
    {
        return parent::getUploadedFiles();
    }

    /**
     * @inheritDoc
     */
    public function getDigestAuth()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getPort()
    {
        return $this->getHttpPort();
    }
}