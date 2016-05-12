<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/12/16
 * Time: 12:58 PM
 */

namespace Vain\Phalcon\Http\Header;

use Phalcon\Http\Response\HeadersInterface as PhalconHeaderInterface;

class PhalconHeader implements PhalconHeaderInterface
{
    /**
     * @inheritDoc
     */
    public function set($name, $value)
    {
        // TODO: Implement set() method.
    }

    /**
     * @inheritDoc
     */
    public function get($name)
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function setRaw($header)
    {
        // TODO: Implement setRaw() method.
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        // TODO: Implement send() method.
    }

    /**
     * @inheritDoc
     */
    public function reset()
    {
        // TODO: Implement reset() method.
    }

    /**
     * @inheritDoc
     */
    public static function __set_state($data)
    {
        // TODO: Implement __set_state() method.
    }

}