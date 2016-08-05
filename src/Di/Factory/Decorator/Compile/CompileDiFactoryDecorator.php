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

use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Vain\Core\Extension\ExtensionInterface;
use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Vain\Phalcon\Di\Factory\Decorator\AbstractDiFactoryDecorator;
use Vain\Phalcon\Exception\UnableToCacheContainerException;

/**
 * Class CompileDiFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CompileDiFactoryDecorator extends AbstractDiFactoryDecorator
{
    /**
     * @param CompileAwareContainerInterface $container
     * @param string                         $containerPath
     *
     * @return CompileAwareContainerInterface
     *
     * @throws UnableToCacheContainerException
     */
    protected function dumpContainer(CompileAwareContainerInterface $container, $containerPath)
    {
        $dumper = new PhpDumper($container);
        if (false === file_exists(dirname($containerPath))) {
            mkdir(dirname($containerPath), 0755, true);
        }
        if (false === file_put_contents($containerPath, $dumper->dump(['class' => 'CachedSymfonyContainer']))) {
            throw new UnableToCacheContainerException($this, $containerPath);
        }

        return $container;
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

        if ($diContainer->has('app.caching')
            && $diContainer->has('app.container.path')
            && $diContainer->get('app.caching')
            && false === file_exists($containerPath = $diContainer->get('app.container.path'))
        ) {
            if ($diContainer->has('app.extensions')) {
                foreach ($diContainer->get('app.extensions') as $extension) {
                    if (false === class_exists($extension)) {
                        continue;
                    }
                    $extension = new $extension;
                    if (false === $extension instanceof ExtensionInterface) {
                        continue;
                    }
                    $extension->register($diContainer);
                }
            }
            $diContainer->compile();
            $this->dumpContainer($diContainer, $containerPath);
        }

        return $diContainer;
    }
}