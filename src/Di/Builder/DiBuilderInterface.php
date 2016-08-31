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
namespace Vain\Phalcon\Di\Builder;

use Phalcon\DiInterface as PhalconDiInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * Interface DiBuilderInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DiBuilderInterface
{
    /**
     * @param mixed $container
     *
     * @return DiBuilderInterface
     */
    public function container($container);

    /**
     * @param string $applicationEnv
     *
     * @return DiBuilderInterface
     */
    public function config($applicationEnv);

    /**
     * @param string $applicationMode
     *
     * @return DiBuilderInterface
     */
    public function mode($applicationMode);


    /**
     * @param string $appDir
     *
     * @return DiBuilderInterface
     */
    public function appDir($appDir);

    /**
     * @param $configDir
     *
     * @return DiBuilderInterface
     */
    public function configDir($configDir);

    /**
     * @param CompilerPassInterface[] $compilePasses
     *
     * @return DiBuilderInterface
     */
    public function compilePasses(array $compilePasses);

    /**
     * @param bool $dump
     *
     * @return DiBuilderInterface
     */
    public function dump($dump = true);

    /**
     * @param ExtensionInterface[] $extensions
     *
     * @return DiBuilderInterface
     */
    public function extensions(array $extensions);

    /**
     * @return PhalconDiInterface
     */
    public function getDi();
}