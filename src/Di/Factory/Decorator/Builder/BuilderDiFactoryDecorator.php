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
namespace Vain\Phalcon\Di\Factory\Decorator\Builder;

use Vain\Phalcon\Di\Builder\DiBuilderInterface;
use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Vain\Phalcon\Di\Factory\Decorator\AbstractDiFactoryDecorator;
use Vain\Phalcon\Di\Factory\DiFactoryInterface;

/**
 * Class BuilderDiFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BuilderDiFactoryDecorator extends AbstractDiFactoryDecorator
{
    private $builder;

    /**
     * BuilderDiFactoryDecorator constructor.
     *
     * @param DiFactoryInterface $diFactory
     * @param DiBuilderInterface $builder
     */
    public function __construct(DiFactoryInterface $diFactory, DiBuilderInterface $builder)
    {
        $this->builder = $builder;
        parent::__construct($diFactory);
    }

    /**
     * @inheritDoc
     */
    public function createDi($applicationEnv, $cachingEnabled)
    {
        /**
         * @var CompileAwareContainerInterface $diContainer
         */
        $diContainer = parent::createDi($applicationEnv, $cachingEnabled);
        $this->builder->container($diContainer);

        if (false === $diContainer->isFrozen()) {
            return $this->builder
                ->config($applicationEnv)
                ->extensions()
                ->compile()
                ->dump();
        }

        return $this->builder->getDi();
    }
}