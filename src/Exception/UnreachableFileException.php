<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/13/16
 * Time: 12:31 PM
 */

namespace Vain\Phalcon\Exception;

use Vain\Core\Exception\CoreException;

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