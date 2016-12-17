<?php

namespace SMB\Arrayto\Plugins\Csv;

use SMB\Arrayto\Interfaces\Writable;
use SMB\Arrayto\Traits;

/**
 * Writer of Csv format
 *
 * @author shimabox.net
 */
class Writer implements Writable
{
    use Traits\Xsv\Creatable, Traits\Xsv\Configurable, Traits\File;

    /**
     * write
     */
    public function write()
    {
        $csv = $this->createOutputContents(
                $this->header,
                $this->delimiter4Csv,
                $this->enclosure,
                $this->toConvert
            );

        $this->save($csv);
    }
}
