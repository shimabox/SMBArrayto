<?php

namespace SMB\Arrayto\Plugins\Json;

use SMB\Arrayto\Interfaces\Outputable;
use SMB\Arrayto\Traits;

/**
 * Outputter of Json format
 *
 * @author shimabox.net
 */
class Outputter implements Outputable
{
    use Traits\Json\Configurable, Traits\Storable /* know $this->rows */;

    /**
     * output
     */
    public function output()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->rows, $this->jsonEncodeOption);
    }
}
