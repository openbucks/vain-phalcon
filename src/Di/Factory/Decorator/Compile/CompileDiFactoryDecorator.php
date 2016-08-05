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
namespace Vain\Phalcon\Di\Factory\Decorator\Compile;

use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Vain\Phalcon\Di\Factory\Decorator\AbstractDiFactoryDecorator;

/**
 * Class CompileDiFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CompileDiFactoryDecorator extends AbstractDiFactoryDecorator
{
    /**
     * @inheritDoc
     */
    public function createDi($applicationEnv, $cachingEnabled)
    {
        /**
         * @var CompileAwareContainerInterface $diContainer
         */
        $diContainer = parent::createDi($applicationEnv, $cachingEnabled);

        if (false === $diContainer->isFrozen()) {
            $diContainer->compile();
        }

        return $diContainer;
    }
}