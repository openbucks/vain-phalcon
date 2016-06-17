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

use Vain\Core\Exception\CoreException;

/**
 * Class UnreachableFileException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnreachableFileException extends CoreException
{
    /**
     * UnreachableFileException constructor.
     * @param string $fileName
     * @param string $mode
     */
    public function __construct($fileName, $mode)
    {
        parent::__construct(sprintf('Cannot open file %s with mode %s', $fileName, $mode), 0, null);
    }
}