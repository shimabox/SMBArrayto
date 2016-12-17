<?php

namespace SMB\Arrayto\Plugins;

use SMB\Arrayto\Interfaces\Downloadable;
use SMB\Arrayto\Interfaces\Outputable;
use SMB\Arrayto\Interfaces\Writable;
use SMB\Arrayto\Traits\Storable;

/**
 * NullObject
 *
 * @author shimabox.net
 */
class NullObject implements Downloadable, Outputable, Writable
{
    use Storable;

    /**
     * download
     * @param string $fileName
     */
    public function download($fileName)
    {
    }

    /**
     * download an existing file
     * @param string $fileName e.g.) sample.xxx | ../sample.xxx | /path/to/sample.xxx
     * @param string $aliasOfFileName
     */
    public function downloadExistsFile($fileName, $aliasOfFileName = '')
    {
    }

    /**
     * download an existing file using Writer
     * @param string $fileName
     * @param \SMB\Arrayto\Interfaces\Writable $writer
     */
    public function downloadExistsFileUsingWriter($fileName, Writable $writer)
    {
    }

    /**
     * output
     */
    public function output()
    {
    }

    /**
     * write
     */
    public function write()
    {
    }
}
