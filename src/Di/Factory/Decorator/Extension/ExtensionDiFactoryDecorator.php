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
namespace Vain\Phalcon\Di\Factory\Decorator\Extension;

use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Vain\Phalcon\Di\Factory\Decorator\AbstractDiFactoryDecorator;

/**
 * Class ExtensionDiFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ExtensionDiFactoryDecorator extends AbstractDiFactoryDecorator
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
        if (false === $diContainer->isFrozen() && $diContainer->has('app.extensions')) {
            foreach ($diContainer->get('app.extensions') as $extension) {
                if (false === $diContainer->has($extension)) {
                    continue;
                }

                $diContainer->get($extension)->register($diContainer);
            }
        }

        return $diContainer;
    }
}