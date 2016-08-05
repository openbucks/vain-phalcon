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
namespace Vain\Phalcon\Di\Symfony;

use Phalcon\Di\InjectionAwareInterface as PhalconDiAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;
use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Vain\Phalcon\Exception\UnsupportedDiCallException;

/**
 * Class SymfonyContainerAdapter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SymfonyContainerAdapter implements CompileAwareContainerInterface
{
    private $symfonyContainer;

    /**
     * SymfonyContainerAdapter constructor.
     * @param SymfonyContainerInterface $symfonyContainer
     */
    public function __construct(SymfonyContainerInterface $symfonyContainer)
    {
        $this->symfonyContainer = $symfonyContainer;
    }

    /**
     * @inheritDoc
     */
    public function isFrozen()
    {
        return $this->symfonyContainer->isFrozen();
    }

    /**
     * @inheritDoc
     */
    public function compile()
    {
        return $this->symfonyContainer->compile();
    }

    /**
     * @inheritDoc
     */
    public function set($name, $definition, $shared = false)
    {
        $this->symfonyContainer->set($name, $definition);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setShared($name, $definition)
    {
        return $this->set($name, $definition);
    }

    /**
     * @inheritDoc
     */
    public function remove($name)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function attempt($name, $definition, $shared = false)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function get($name, $parameters = null)
    {
        $result = $this->symfonyContainer->get($name);

        if ($result instanceof PhalconDiAwareInterface) {
            $result->setDI($this);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getShared($name, $parameters = null)
    {
        return $this->get($name, $parameters);
    }

    /**
     * @inheritDoc
     */
    public function setRaw($name, \Phalcon\Di\ServiceInterface $rawDefinition)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function getRaw($name)
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function getService($name)
    {
        return $this->get($name);
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return $this->symfonyContainer->has($name);
    }

    /**
     * @inheritDoc
     */
    public function wasFreshInstance()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getServices()
    {
        throw new UnsupportedDiCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public static function setDefault(\Phalcon\DiInterface $dependencyInjector)
    {
        throw new UnsupportedDiCallException($dependencyInjector, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public static function getDefault()
    {

    }

    /**
     * @inheritDoc
     */
    public static function reset()
    {
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        return $this->remove($offset);
    }
}