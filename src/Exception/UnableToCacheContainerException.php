<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
namespace Vain\Phalcon\Exception;

use Vain\Phalcon\Bootstrapper\BootstrapperInterface;

/**
 * Class UnableToCacheContainerException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnableToCacheContainerException extends BootstrapperException
{
    /**
     * UnableToCacheContainerException constructor.
     *
     * @param BootstrapperInterface $bootstrapper
     * @param string                $filename
     */
    public function __construct(BootstrapperInterface $bootstrapper, $filename)
    {
        parent::__construct($bootstrapper, sprintf('Unable to write container to %s', $filename), 0, null);
    }
}