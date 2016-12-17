<?php

namespace SMB\Arrayto\Plugins\Csv;

use SMB\Arrayto\Interfaces\Outputable;
use SMB\Arrayto\Traits;

/**
 * Outputter of Csv format
 *
 * @author shimabox.net
 */
class Outputter implements Outputable
{
    use Traits\Xsv\Creatable, Traits\Xsv\Configurable;

    /**
     * output
     */
    public function output()
    {
        header("Content-Type: text/csv; charset={$this->getHeaderCharset()}");
        echo $this->createOutputContents(
                $this->header, 
                $this->delimiter4Csv, 
                $this->enclosure,
                $this->toConvert
            );
    }
}
