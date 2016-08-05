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
namespace Vain\Phalcon\Bootstrapper\Decorator\Extension;

use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Phalcon\Application as PhalconApplication;

/**
 * Class ExtensionBootstrapperDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ExtensionBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconApplication $application)
    {
        /**
         * @var CompileAwareContainerInterface $diContainer
         */
        $diContainer = $application->getDI();
        if (false === $diContainer->isFrozen() && $diContainer->has('app.extensions')) {
            foreach ($diContainer->get('app.extensions') as $extension) {
                if (false === $diContainer->has($extension)) {
                    continue;
                }

                $diContainer->get($extension)->register($diContainer);
            }
        }
        $diContainer->compile();

        return parent::bootstrap($application);
    }
}