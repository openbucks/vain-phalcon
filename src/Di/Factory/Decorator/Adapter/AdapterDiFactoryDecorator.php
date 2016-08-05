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
namespace Vain\Phalcon\Di\Factory\Decorator\Adapter;

use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Vain\Phalcon\Di\Factory\Decorator\AbstractDiFactoryDecorator;
use Vain\Phalcon\Di\Symfony\SymfonyContainerAdapter;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;

/**
 * Class AdapterDiFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class AdapterDiFactoryDecorator extends AbstractDiFactoryDecorator
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

        return new SymfonyContainerAdapter($diContainer);
    }
}