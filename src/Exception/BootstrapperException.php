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
namespace Vain\Phalcon\Exception;

use Vain\Core\Exception\CoreException;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;

/**
 * Class BootstrapperException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BootstrapperException extends CoreException
{
    private $bootstrapper;

    /**
     * BootstrapperException constructor.
     *
     * @param BootstrapperInterface $bootstrapper
     * @param string                $message
     * @param int                   $code
     * @param \Exception|null       $previous
     */
    public function __construct(BootstrapperInterface $bootstrapper, $message, $code, \Exception $previous = null)
    {
        $this->bootstrapper = $bootstrapper;
        parent::__construct($message, $code, $previous);
    }
}