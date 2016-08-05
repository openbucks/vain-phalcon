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

use Vain\Phalcon\Di\Factory\Decorator\AbstractDiFactoryDecorator;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;

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
         * @var SymfonyContainerInterface $diContainer
         */
        $diContainer = parent::createDi($applicationEnv, $cachingEnabled);
        if (false === $diContainer->isFrozen() && $diContainer->hasParameter('app.extensions')) {
            foreach ($diContainer->getParameter('app.extensions') as $extension) {
                if (false === $diContainer->has($extension)) {
                    continue;
                }

                $diContainer->get($extension)->load([], $diContainer);
            }
        }

        return $diContainer;
    }
}