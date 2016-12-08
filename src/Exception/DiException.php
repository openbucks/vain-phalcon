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
declare(strict_types = 1);

namespace Vain\Phalcon\Exception;

use Phalcon\DiInterface as PhalconDiInterface;
use Vain\Core\Exception\AbstractCoreException;

/**
 * Class DiException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DiException extends AbstractCoreException
{
    private $di;

    /**
     * DiException constructor.
     *
     * @param PhalconDiInterface $di
     * @param string             $message
     * @param int                $code
     * @param \Exception         $previous
     */
    public function __construct(PhalconDiInterface $di, string $message, int $code = 500, \Exception $previous = null)
    {
        $this->di = $di;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return PhalconDiInterface
     */
    public function getDi()
    {
        return $this->di;
    }
}
