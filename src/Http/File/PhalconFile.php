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
namespace Vain\Phalcon\Http\File;

use Phalcon\Http\Request\FileInterface as PhalconFileInterface;
use Vain\Http\File\AbstractFile;

/**
 * Class PhalconFile
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconFile extends AbstractFile implements PhalconFileInterface
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getClientFilename();
    }

    /**
     * @inheritDoc
     */
    public function getTempName()
    {
        return $this->getStream()->getMetadata('uri');
    }

    /**
     * @inheritDoc
     */
    public function getType()
    {
        return $this->getClientMediaType();
    }

    /**
     * @inheritDoc
     */
    public function getRealType()
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        if (false === is_resource($fileInfo)) {
            return '';
        }

        return finfo_file($fileInfo, $this->getStream()->getResource());
    }

    /**
     * Checks whether the file has been uploaded via Post.
     */
    public function isUploadedFile()
    {
        return is_uploaded_file($this->getTempName());
    }
}
