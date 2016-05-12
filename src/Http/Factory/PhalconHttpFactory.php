<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/12/16
 * Time: 12:18 PM
 */

namespace Vain\Phalcon\Http\Factory;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Vain\Http\File\Factory\FileFactoryInterface;
use Vain\Http\Stream\Factory\StreamFactoryInterface;
use Vain\Http\Uri\Factory\UriFactoryInterface;
use Vain\Http\Uri\VainUriInterface;

class PhalconHttpFactory implements FileFactoryInterface, UriFactoryInterface, StreamFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createFile($source, $size, $error, $fileName, $mediaType)
    {
        // TODO: Implement createFile() method.
    }

    /**
     * @inheritDoc
     */
    public function createStream($source, $mode)
    {
        // TODO: Implement createStream() method.
    }

    /**
     * @inheritDoc
     */
    public function createUri($uri)
    {
        // TODO: Implement createUri() method.
    }
}