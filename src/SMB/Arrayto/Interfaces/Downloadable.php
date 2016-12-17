<?php

namespace SMB\Arrayto\Interfaces;

/**
 * Interface for download
 *
 * @author shimabox.net
 */
interface Downloadable
{
    /**
     * download
     * @param string $filePath
     */
    public function download($filePath);

    /**
     * download an existing file
     * @param string $fileName e.g.) sample.xxx | ../sample.xxx | /path/to/sample.xxx
     * @param string $aliasOfFileName
     */
    public function downloadExistsFile($fileName, $aliasOfFileName = '');

    /**
     * download an existing file using Writer
     * @param string $fileName
     * @param \SMB\Arrayto\Interfaces\Writable $writer
     */
    public function downloadExistsFileUsingWriter($fileName, Writable $writer);
}
