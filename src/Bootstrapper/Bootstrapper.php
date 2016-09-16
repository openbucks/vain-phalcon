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
namespace Vain\Phalcon\Bootstrapper;

use Phalcon\Application as PhalconApplication;

/**
 * Class Bootstrapper
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class Bootstrapper implements BootstrapperInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconApplication $application)
    {
        return $this;
    }
}