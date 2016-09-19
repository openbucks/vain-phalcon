<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-phalcon
 */
namespace Vain\Phalcon\Dispatcher\Mvc;

use Phalcon\Mvc\Dispatcher as PhalconMvcDispatcher;

/**
 * Class MvcDispatcher
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MvcDispatcher extends PhalconMvcDispatcher
{
    private $separator;

    /**
     * MvcDispatcher constructor.
     *
     * @param $separator
     */
    public function __construct($separator)
    {
        $this->separator = $separator;
    }

    /**
     * @return string
     */
    public function getHandlerClass()
    {
        $this->_resolveEmptyProperties();

        if (false === strpos("\\", $this->_handlerName)) {
            $camelizedClass = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_handlerName)));
        } else {
            $camelizedClass = $this->_handlerName;
        }

        if (null === $this->_namespaceName) {
            return $camelizedClass . $this->_handlerSuffix;
        }

        $namespace = $this->_namespaceName;
        if ($this->separator !== substr($namespace, -1)) {
            $namespace .= $this->separator;
        }

        return $namespace . $camelizedClass . $this->_handlerSuffix;
    }
}