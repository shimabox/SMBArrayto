<?php

namespace SMB\Arrayto\Plugins\Tsv;

use SMB\Arrayto\Interfaces\Writable;
use SMB\Arrayto\Traits;

/**
 * Writer of Tsv format
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
        $tsv = $this->createOutputContents(
                $this->header,
                $this->delimiter4Tsv,
                $this->enclosure,
                $this->toConvert
            );

        $this->save($tsv);
    }
}
