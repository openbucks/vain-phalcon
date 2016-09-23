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
namespace Vain\Phalcon\Http\Factory;

use Phalcon\FilterInterface as PhalconFilterInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Vain\Http\Cookie\Factory\CookieFactoryInterface;
use Vain\Http\Exception\UnsupportedUriException;
use Vain\Http\File\Factory\FileFactoryInterface;
use Vain\Http\Header\Factory\HeaderFactoryInterface;
use Vain\Http\Header\Provider\HeaderProviderInterface;
use Vain\Http\Message\VainMessageInterface;
use Vain\Http\Request\Factory\RequestFactoryInterface;
use Vain\Http\Request\VainServerRequestInterface;
use Vain\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Http\Response\VainResponseInterface;
use Vain\Http\Stream\Factory\StreamFactoryInterface;
use Vain\Http\Stream\StringStream;
use Vain\Http\Stream\VainStreamInterface;
use Vain\Http\Uri\Factory\UriFactoryInterface;
use Vain\Http\Uri\VainUriInterface;
use Vain\Phalcon\Exception\UnknownFilesException;
use Vain\Phalcon\Exception\UnknownProtocolException;
use Vain\Phalcon\Exception\UnreachableFileException;
use Vain\Phalcon\Http\Cookie\Factory\PhalconCookieFactory;
use Vain\Phalcon\Http\Cookie\Storage\PhalconCookieStorage;
use Vain\Phalcon\Http\File\PhalconFile;
use Vain\Phalcon\Http\Header\Storage\PhalconHeadersStorage;
use Vain\Phalcon\Http\Request\PhalconRequest;
use Vain\Phalcon\Http\Response\PhalconResponse;
use Vain\Phalcon\Http\Stream\PhalconStream;
use Vain\Phalcon\Http\Uri\PhalconUri;

/**
 * Class PhalconHttpFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconHttpFactory implements
    FileFactoryInterface,
    UriFactoryInterface,
    StreamFactoryInterface,
    RequestFactoryInterface,
    ResponseFactoryInterface
{
    private $filter;

    private $headerProvider;

    private $cookieFactory;

    private $headerFactory;

    /**
     * PhalconHttpFactory constructor.
     *
     * @param PhalconFilterInterface  $phalconFilter
     * @param HeaderProviderInterface $headerProvider
     * @param CookieFactoryInterface  $cookieFactory
     * @param HeaderFactoryInterface  $headerFactory
     */
    public function __construct(
        PhalconFilterInterface $phalconFilter,
        HeaderProviderInterface $headerProvider,
        CookieFactoryInterface $cookieFactory,
        HeaderFactoryInterface $headerFactory
    ) {
        $this->filter = $phalconFilter;
        $this->headerProvider = $headerProvider;
        $this->cookieFactory = $cookieFactory;
        $this->headerFactory = $headerFactory;
    }

    /**
     * @inheritDoc
     */
    public function createFile(
        string $source,
        int $size,
        int $error,
        string $fileName,
        string $mediaType
    ) : UploadedFileInterface
    {
        return new PhalconFile($this->createStream($source, 'r+'), $size, $error, $fileName, $mediaType);
    }

    /**
     * @inheritDoc
     */
    public function createStream(string $source, string $mode) : StreamInterface
    {
        if (false === ($resource = @fopen($source, $mode))) {
            throw new UnreachableFileException($source, $mode);
        }

        return new StringStream((new PhalconStream($resource, $mode))->getContents());
    }

    /**
     * @param array  $array
     * @param string $element
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function extractKey(array $array, string $element, $default)
    {
        if (false === array_key_exists($element, $array)) {
            return $default;
        }

        return $array[$element];
    }

    /**
     * @inheritDoc
     */
    public function createUri(string $uri) : VainUriInterface
    {
        if (false === ($explode = parse_url($uri))) {
            throw new UnsupportedUriException($this, $uri);
        }

        $extractedParts = [];
        foreach ([
                     self::PARSE_URL_SCHEME   => '',
                     self::PARSE_URL_USER     => '',
                     self::PARSE_URL_PASS     => '',
                     self::PARSE_URL_HOST     => '',
                     self::PARSE_URL_PORT     => 0,
                     self::PARSE_URL_PATH     => '',
                     self::PARSE_URL_QUERY    => '',
                     self::PARSE_URL_FRAGMENT => '',
                 ] as $element => $default) {
            $extractedParts[] = $this->extractKey($explode, $element, $default);
        }

        return new PhalconUri(...$extractedParts);
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws UnknownFilesException
     */
    protected function createFiles(array $data)
    {
        $files = [];
        foreach ($data as $key => $fileSpec) {
            switch (true) {
                case is_array($fileSpec) && array_key_exists('tmp_name', $fileSpec):
                    $files[$key] = $this->processFile(
                        $fileSpec['tmp_name'],
                        $fileSpec['size'],
                        $fileSpec['error'],
                        $fileSpec['name'],
                        $fileSpec['type']
                    );
                    break;
                case is_array($fileSpec):
                    $files[$key] = $this->createFiles($fileSpec);
                    break;
                default:
                    throw new UnknownFilesException($this, $key);
            }
        }

        return $files;
    }

    /**
     * @param string $tmpName
     * @param int    $size
     * @param int    $error
     * @param string $name
     * @param string $type
     *
     * @return UploadedFileInterface[]|UploadedFileInterface
     */
    protected function processFile($tmpName, $size, $error, $name, $type)
    {
        if (false === is_array($tmpName)) {
            return $this->createFile($tmpName, $size, $error, $name, $type);
        }
        $files = [];
        foreach (array_keys($tmpName) as $tmpFileName) {
            $files[$tmpFileName] = $this->processFile(
                $tmpFileName,
                $size[$tmpFileName],
                $error[$tmpFileName],
                $name[$tmpFileName],
                $type[$tmpFileName]
            );
        }

        return $files;
    }

    /**
     * @param string $protocol
     *
     * @return string mixed
     * @throws UnknownProtocolException
     */
    protected function transformProtocol($protocol)
    {
        $matches = [];
        preg_match('/HTTP\/([\d\.]*)/', $protocol, $matches);
        switch (count($matches)) {
            case 2:
                return $matches[1];
                break;
            default:
                throw new UnknownProtocolException($this, $protocol);
        }
    }

    /**
     * @param string $requestMethod
     * @param array  $get
     * @param array  $request
     *
     * @return array
     */
    protected function getQueryParams($requestMethod, array $get, array $request)
    {
        if ('GET' === $requestMethod) {
            return $get;
        }

        return $request;
    }

    /**
     * @param string          $requestMethod
     * @param string          $contentType
     * @param StreamInterface $stream
     * @param array           $post
     *
     * @return array
     */
    protected function parseBody($requestMethod, $contentType, StreamInterface $stream, array $post)
    {
        if (false === in_array($requestMethod, ['POST', 'PUT', 'PATCH'])) {
            return [];
        }

        $contents = $stream->getContents();
        switch ($contentType) {
            case VainMessageInterface::CONTENT_TYPE_URL_ENCODED:
            case VainMessageInterface::CONTENT_TYPE_FORM_DATA:
                if ($requestMethod === 'POST') {
                    return $post;
                }
                $body = [];
                parse_str($contents, $body);

                return $body;
                break;
            case VainMessageInterface::CONTENT_TYPE_APPLICATION_JSON:
                $body = json_decode($contents, true);

                return $body;
                break;
            default:
                return $post;
                break;
        }
    }

    /**
     * @inheritDoc
     */
    public function createFromGlobals()
    {
        $files = $this->createFiles($_FILES);
        $cookieStorage = new PhalconCookieStorage(new PhalconCookieFactory());
        foreach ($_COOKIE as $cookieName => $cookieValue) {
            $cookies[] = $cookieStorage->createCookie($cookieName, $cookieValue);
        }
        $headerStorage = new PhalconHeadersStorage($this->headerFactory);
        foreach ($this->headerProvider->getHeaders($_SERVER) as $headerName => $headerValue) {
            $headerStorage->createHeader($headerName, $headerValue);
        }
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        $stream = $this->createStream('php://input', 'r');

        return new PhalconRequest(
            $this->filter,
            $_SERVER,
            $files,
            $this->getQueryParams(strtoupper($_SERVER['REQUEST_METHOD']), $_GET, $_REQUEST),
            [],
            $this->parseBody(strtoupper($_SERVER['REQUEST_METHOD']), $contentType, $stream, $_POST),
            $this->transformProtocol($_SERVER['SERVER_PROTOCOL']),
            $_SERVER['REQUEST_METHOD'],
            $this->createUri($_SERVER['REQUEST_URI']),
            $stream,
            $cookieStorage,
            $headerStorage
        );
    }

    /**
     * @inheritDoc
     */
    public function createRequest(
        array $serverParams,
        array $uploadedFiles,
        array $queryParams,
        array $attributes,
        array $parsedBody,
        string $protocol,
        string $method,
        VainUriInterface $uri,
        VainStreamInterface $stream,
        array $cookies,
        array $headers
    ) : VainServerRequestInterface
    {
        $cookieStorage = new PhalconCookieStorage(new PhalconCookieFactory());
        foreach ($cookies as $cookieName => $cookieValue) {
            $cookies[] = $cookieStorage->createCookie($cookieName, $cookieValue);
        }
        $headerStorage = new PhalconHeadersStorage($this->headerFactory);
        foreach ($this->headerProvider->getHeaders($serverParams) as $headerName => $headerValue) {
            $headerStorage->createHeader($headerName, $headerValue);
        }

        return new PhalconRequest(
            $this->filter,
            $serverParams,
            $uploadedFiles,
            $queryParams,
            $attributes,
            $parsedBody,
            $protocol,
            $method,
            $uri,
            $stream,
            $cookieStorage,
            $headerStorage
        );
    }

    /**
     * @inheritDoc
     */
    public function createResponse(
        string $destinationStream,
        int $statusCode = 200,
        array $headersData = [],
        string $content = ''
    ) : VainResponseInterface
    {
        $headerStorage = new PhalconHeadersStorage($this->headerFactory);
        foreach ($headersData as $headerName => $headerValue) {
            $headerStorage->createHeader($headerName, $headerValue);
        }

        $stream = $this->createStream($destinationStream, 'w+');
        $stream->write($content);

        return new PhalconResponse($statusCode, $stream, $headerStorage);
    }
}