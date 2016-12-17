<?php

namespace SMB\Arrayto\Plugins\Tsv;

use SMB\Arrayto\Interfaces\Outputable;
use SMB\Arrayto\Traits;

/**
 * Outputter of Tsv format
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
        header("Content-Type: text/tab-separated-values; charset={$this->getHeaderCharset()}");
        echo $this->createOutputContents(
                $this->header, 
                $this->delimiter4Tsv, 
                $this->enclosure,
                $this->toConvert
            );
    }
}
