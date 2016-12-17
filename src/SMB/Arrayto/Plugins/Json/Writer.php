<?php

namespace SMB\Arrayto\Plugins\Json;

use SMB\Arrayto\Interfaces\Writable;
use SMB\Arrayto\Traits;

/**
 * Writer of Json format
 *
 * @author shimabox.net
 */
class Writer implements Writable
{
    use Traits\Json\Configurable, Traits\Storable /* know $this->rows */, Traits\File;

    /**
     * write
     */
    public function write()
    {
        $json = json_encode($this->rows, $this->jsonEncodeOption);
        $this->save($json);
    }
}
