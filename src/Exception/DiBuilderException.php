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

use Vain\Core\Exception\AbstractCoreException;
use Vain\Phalcon\Di\Builder\DiBuilderInterface;

/**
 * Class DiBuilderException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DiBuilderException extends AbstractCoreException
{
    private $builder;

    /**
     * DiBuilderException constructor.
     *
     * @param DiBuilderInterface $builder
     * @param string             $message
     * @param int                $code
     * @param \Exception|null    $previous
     */
    public function __construct(
        DiBuilderInterface $builder,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->builder = $builder;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return DiBuilderInterface
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
