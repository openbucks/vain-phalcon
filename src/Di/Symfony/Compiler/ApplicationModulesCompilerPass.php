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

namespace Vain\Phalcon\Di\Symfony\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ApplicationModulesCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApplicationModulesCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->has('app.mvc')) {
            return $this;
        }

        $definition = $container->findDefinition('app.mvc');
        $services = $container->findTaggedServiceIds('app.module');
        foreach ($services as $id => $tags) {
            $definition->addMethodCall('addModule', [$id, new Reference($id)]);
        }

        return $this;
    }
}