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
namespace Vain\Phalcon\Di\Factory\Decorator;

use Vain\Phalcon\Di\Factory\DiFactoryInterface;

/**
 * Class AbstractDiFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDiFactoryDecorator implements DiFactoryInterface
{
    private $diFactory;

    /**
     * AbstractDiFactoryDecorator constructor.
     *
     * @param DiFactoryInterface $diFactory
     */
    public function __construct(DiFactoryInterface $diFactory)
    {
        $this->diFactory = $diFactory;
    }

    /**
     * @inheritDoc
     */
    public function createDi($applicationEnv, $cachingEnabled)
    {
        return $this->diFactory->createDi($applicationEnv, $cachingEnabled);
    }
}