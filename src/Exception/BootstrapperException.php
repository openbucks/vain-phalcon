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
declare(strict_types = 1);

namespace Vain\Phalcon\Exception;

use Vain\Core\Bootstrapper\BootstrapperInterface;
use Vain\Core\Exception\AbstractCoreException;

/**
 * Class BootstrapperException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BootstrapperException extends AbstractCoreException
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
    public function __construct(
        BootstrapperInterface $bootstrapper,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->bootstrapper = $bootstrapper;
        parent::__construct($message, $code, $previous);
    }
}
