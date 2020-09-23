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
use Phalcon\Text as PhalconText;

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
    public function getHandlerClass(): string
    {
        $this->resolveEmptyProperties();

        if (false === strpos("\\", $this->handlerName)) {
            $camelizedClass = PhalconText::camelize($this->handlerName, '_-');
        } else {
            $camelizedClass = $this->handlerName;
        }

        if (null === $this->namespaceName) {
            return strtolower(sprintf('%s%s%s', $camelizedClass, $this->separator, $this->handlerSuffix));
        }

        $namespace = $this->namespaceName;
        if ($this->separator !== substr($namespace, -1)) {
            $namespace .= $this->separator;
        }

        return strtolower($namespace . $camelizedClass . $this->handlerSuffix);
    }
}
