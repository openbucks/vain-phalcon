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
use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;

/**
 * Interface DiBuilderInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DiBuilderInterface
{
    /**
     * @param CompileAwareContainerInterface $container
     *
     * @return DiBuilderInterface
     */
    public function container(CompileAwareContainerInterface $container);

    /**
     * @param string $applicationEnv
     *
     * @return DiBuilderInterface
     */
    public function config($applicationEnv);

    /**
     * @param bool $compile
     *
     * @return DiBuilderInterface
     */
    public function compile($compile = true);

    /**
     * @param bool $dump
     *
     * @return DiBuilderInterface
     */
    public function dump($dump = true);

    /**
     * @param bool $extensions
     *
     * @return DiBuilderInterface
     */
    public function extensions($extensions = true);

    /**
     * @return PhalconDiInterface
     */
    public function getDi();
}