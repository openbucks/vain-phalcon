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

use Vain\Core\Exception\AbstractCoreException;

/**
 * Class UnreachableFileException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnreachableFileException extends AbstractCoreException
{
    /**
     * UnreachableFileException constructor.
     *
     * @param string $fileName
     * @param string $mode
     */
    public function __construct($fileName, $mode)
    {
        parent::__construct(sprintf('Cannot open file %s with mode %s', $fileName, $mode));
    }
}