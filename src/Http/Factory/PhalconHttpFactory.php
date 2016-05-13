<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/12/16
 * Time: 12:18 PM
 */

namespace Vain\Phalcon\Http\Factory;

use Vain\Http\Exception\UnsupportedUriException;
use Vain\Http\File\Factory\FileFactoryInterface;
use Vain\Http\Stream\Factory\StreamFactoryInterface;
use Vain\Http\Uri\Factory\UriFactoryInterface;
use Vain\Phalcon\Exception\UnreachableFileException;
use Vain\Phalcon\Http\File\PhalconFile;
use Vain\Phalcon\Http\Stream\PhalconStream;
use Vain\Phalcon\Http\Uri\PhalconUri;

class PhalconHttpFactory implements FileFactoryInterface, UriFactoryInterface, StreamFactoryInterface
{
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
}