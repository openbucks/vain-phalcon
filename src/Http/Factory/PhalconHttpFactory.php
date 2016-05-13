<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/12/16
 * Time: 12:18 PM
 */

namespace Vain\Phalcon\Http\Factory;

use Phalcon\FilterInterface as PhalconFilterInterface;
use Vain\Http\Cookie\Factory\CookieFactoryInterface;
use Vain\Http\Cookie\VainCookieInterface;
use Vain\Http\Exception\UnsupportedUriException;
use Vain\Http\File\Factory\FileFactoryInterface;
use Vain\Http\Header\Factory\HeaderFactoryInterface;
use Vain\Http\Header\VainHeaderInterface;
use Vain\Http\Request\Factory\RequestFactoryInterface;
use Vain\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Http\Stream\Factory\StreamFactoryInterface;
use Vain\Http\Uri\Factory\UriFactoryInterface;
use Vain\Phalcon\Exception\UnreachableFileException;
use Vain\Phalcon\Http\Cookie\PhalconCookie;
use Vain\Phalcon\Http\File\PhalconFile;
use Vain\Phalcon\Http\Header\PhalconHeader;
use Vain\Phalcon\Http\Header\Storage\PhalconHeadersStorage;
use Vain\Phalcon\Http\Request\PhalconRequest;
use Vain\Phalcon\Http\Stream\PhalconStream;
use Vain\Phalcon\Http\Uri\PhalconUri;

class PhalconHttpFactory implements
    FileFactoryInterface,
    UriFactoryInterface,
    StreamFactoryInterface,
    CookieFactoryInterface,
    RequestFactoryInterface,
    ResponseFactoryInterface,
    HeaderFactoryInterface
{
    private $filter;

    private $headerFactory;

    /**
     * PhalconHttpFactory constructor.
     * @param PhalconFilterInterface $phalconFilter
     * @param HeaderFactoryInterface $headerFactory
     */
    public function __construct(PhalconFilterInterface $phalconFilter, HeaderFactoryInterface $headerFactory)
    {
        $this->filter = $phalconFilter;
        $this->headerFactory = $headerFactory;
    }

    /**
     * @inheritDoc
     */
    public function createFile($source, $size, $error, $fileName, $mediaType)
    {
        return new PhalconFile($source, $size, $error, $fileName, $mediaType);
    }

    /**
     * @inheritDoc
     */
    public function createStream($source, $mode)
    {
        if (false === ($resource = @fopen($source, $mode))) {
            throw new UnreachableFileException($source, $mode);
        }

        return new PhalconStream($resource);
    }

    /**
     * @param string $element
     * @param array $array
     *
     * @return string|null
     */
    protected function extractKey($element, array $array)
    {
        if (false === array_key_exists($element, $array)) {
            return null;
        }

        return $array[$element];
    }

    /**
     * @inheritDoc
     */
    public function createUri($uri)
    {
        if (false === ($explode = parse_url($uri))) {
            throw new UnsupportedUriException($this, $uri);
        }

        $extractedParts = [];
        foreach ([PHP_URL_SCHEME, PHP_URL_USER, PHP_URL_PASS, PHP_URL_HOST, PHP_URL_PORT, PHP_URL_PATH, PHP_URL_QUERY, PHP_URL_FRAGMENT] as $element) {
            $extractedParts[] = $this->extractKey($element, $explode);
        }

        return new PhalconUri(...$extractedParts);
    }

    /**
     * @inheritDoc
     */
    public function createCookie($name, $value, \DateTime $expiryDate = null, $path = '/', $domain = null, $secure = false, $httpOnly = false)
    {
        return new PhalconCookie($name, $value, $expiryDate, $path, $domain, $secure, $httpOnly);
    }

    /**
     * @inheritDoc
     */
    public function createHeader($name, array $values)
    {
        return new PhalconHeader($name, $values);
    }

    protected function createFiles(array $filesData)
    {

    }

    protected function createCookies(array $cookiesData)
    {

    }

    protected function transformProtocol($protocol)
    {

    }


    public function createRequest(array $serverParams, array $queryParams, array $attributes, $body, array $filesData, array $cookiesData, $streamSource)
    {
        $files = $this->createFiles($filesData);
        $cookies = $this->createCookies($cookiesData);
        $headerStorage = new PhalconHeadersStorage($this->headerFactory);
        foreach (getallheaders() as $headerName => $headerValue) {
            $headerStorage->createHeader($headerName, $headerValue);
        }

        return new PhalconRequest($this->filter, $serverParams , $files, $cookies, $queryParams, $attributes, $body, $this->transformProtocol($serverParams['REQUEST_PROTOCOL']) ,$serverParams['REQUEST_METHOD'], $this->createUri($serverParams['REQUEST_URI']), $this->createStream($streamSource, 'r'), $headerStorage);
    }

    public function createResponse()
    {
        // TODO: Implement createResponse() method.
    }


}