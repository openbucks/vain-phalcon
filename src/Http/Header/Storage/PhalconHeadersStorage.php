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

namespace Vain\Phalcon\Http\Header\Storage;

use Phalcon\Http\Response\HeadersInterface as PhalconHeadersInterface;
use Vain\Http\Header\Storage\AbstractHeaderStorage;
use Vain\Phalcon\Exception\UnsupportedHeaderStorageCallException;
use Vain\Phalcon\Http\Header\Factory\PhalconHeaderFactory;

/**
 * Class PhalconHeadersStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconHeadersStorage extends AbstractHeaderStorage implements PhalconHeadersInterface
{
    /**
     * @inheritDoc
     */
    public function set($name, $value)
    {
        return $this->createHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function get($name)
    {
        if (null === ($header = $this->getHeader($name))) {
            return false;
        }

        return implode(', ', $header->getValues());
    }

    /**
     * @inheritDoc
     */
    public function setRaw($header)
    {
        throw new UnsupportedHeaderStorageCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        throw new UnsupportedHeaderStorageCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function reset()
    {
        return $this->resetHeaders();
    }

    /**
     * @inheritDoc
     */
    public static function __set_state(array $data)
    {
        $instance = new self(new PhalconHeaderFactory());
        if (false === array_key_exists('_headers', $data)) {
            foreach ($data['_headers'] as $name => $value) {
                $instance->set($name, $value);
            }
        }

        return $instance;
    }
}
