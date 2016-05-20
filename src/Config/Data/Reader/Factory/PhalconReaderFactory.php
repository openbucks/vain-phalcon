<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 10:25 AM
 */

namespace Vain\Phalcon\Config\Data\Reader\Factory;

use Vain\Config\Data\Reader\Factory\ReaderFactoryInterface;
use Vain\Config\Handler\Yaml\YamlHandler;

class PhalconReaderFactory implements ReaderFactoryInterface
{
    private $applicationPath;

    /**
     * PhalconReaderFactory constructor.
     * @param string $applicationPath
     */
    public function __construct($applicationPath)
    {
        $this->applicationPath = $applicationPath;
    }

    /**
     * @inheritDoc
     */
    public function createReader($filename)
    {
        return new YamlHandler($this->applicationPath, $filename);
    }
}