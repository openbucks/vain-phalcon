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
namespace Vain\Phalcon\Bootstrapper\Decorator;

use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Phalcon\Di\Injectable as PhalconDiInjectable;

/**
 * Class AbstractBootstrapperDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractBootstrapperDecorator implements BootstrapperInterface
{
    private $bootstrapper;

    /**
     * AbstractBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     */
    public function __construct(BootstrapperInterface $bootstrapper)
    {
        $this->bootstrapper = $bootstrapper;
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        return $this->bootstrapper->bootstrap($application);
    }

    /**
     * @return BootstrapperInterface
     */
    public function getBootstrapper()
    {
        return $this->bootstrapper;
    }
}