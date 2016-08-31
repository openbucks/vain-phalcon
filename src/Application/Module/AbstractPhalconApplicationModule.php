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

namespace Vain\Phalcon\Application\Module;

/**
 * Class AbstractPhalconApplicationModule
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractPhalconApplicationModule implements PhalconApplicationModuleInterface
{
    private $name;

    /**
     * AbstractPhalconApplicationModule constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function registerServices(\Phalcon\DiInterface $dependencyInjector)
    {
        return $this;
    }
}