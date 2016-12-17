<?php

namespace SMB\Arrayto\Traits\Json;

/**
 * Json option settings
 *
 * @author shimabox.net
 */
trait Configurable
{
    /**
     * json_encode options
     * @var int default : 448 (JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
     */
    protected $jsonEncodeOption = 448;

    /**
     * setter of json_encode options<br>
     * (e.g <br>
     * - JSON_FORCE_OBJECT | JSON_PRETTY_PRINT <br>
     * - 0 (No option)
     * @param int $option
     * @return this
     */
    public function setJsonEncodeOption($option)
    {
        $this->jsonEncodeOption = $option;
        return $this;
    }
}
