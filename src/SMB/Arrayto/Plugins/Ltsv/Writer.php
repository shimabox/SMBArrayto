<?php

namespace SMB\Arrayto\Plugins\Ltsv;

use SMB\Arrayto\Interfaces\Writable;
use SMB\Arrayto\Traits;

/**
 * Writer of Ltsv format
 *
 * @author shimabox.net
 */
class Writer implements Writable
{
    use Traits\Ltsv\Creatable, Traits\File;

    /**
     * write
     */
    public function write()
    {
        $ltsv = $this->createOutputContents();
        $this->save($ltsv);
    }
}
