<?php

namespace SMB\Arrayto\Plugins\Xml;

use SMB\Arrayto\Interfaces\Writable;
use SMB\Arrayto\Traits;

/**
 * Writer of XML format
 *
 * @author shimabox.net
 */
class Writer implements Writable
{
    use Traits\Xml\Creatable, Traits\File;

    /**
     * write
     */
    public function write()
    {
        $xml = $this->createOutputContents();
        $this->save($xml);
    }
}
