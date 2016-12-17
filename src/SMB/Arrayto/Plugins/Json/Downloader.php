<?php

namespace SMB\Arrayto\Plugins\Json;

use SMB\Arrayto\Interfaces\Downloadable;
use SMB\Arrayto\Interfaces\Writable;
use SMB\Arrayto\Traits;

/**
 * Downloader of Json format
 *
 * @author shimabox.net
 */
class Downloader implements Downloadable
{
    use Traits\Json\Configurable, Traits\Storable /* know $this->rows */;

    /**
     * download
     * @param string $fileName
     */
    public function download($fileName)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Content-Disposition: attachment; filename={$fileName}");

        echo json_encode($this->rows, $this->jsonEncodeOption);
    }

    /**
     * download an existing file
     * @param string $fileName e.g.) sample.xxx | ../sample.xxx | /path/to/sample.xxx
     * @param string $aliasOfFileName
     */
    public function downloadExistsFile($fileName, $aliasOfFileName = '')
    {
        $baseFileName = $aliasOfFileName === '' ? basename($fileName) : $aliasOfFileName;

        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename={$baseFileName}");

        readfile($fileName);
    }

    /**
     * download an existing file using Writer
     * @param string $fileName
     * @param \SMB\Arrayto\Interfaces\Writable $writer
     */
    public function downloadExistsFileUsingWriter($fileName, Writable $writer)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Content-Disposition: attachment; filename={$fileName}");

        $writer->write();
        readfile($writer->getFileName());
    }
}
