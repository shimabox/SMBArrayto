<?php

namespace SMB\Arrayto\Traits\Ltsv;

use SMB\Arrayto\Traits\Storable;
use SMB\Arrayto\Formatter\LtsvFormatter;

/**
 * Ltsv output content creation
 *
 * @author shimabox.net
 */
trait Creatable
{
    use Storable; // know $this->rows
    
    /**
     * End of line
     * @var string
     */
    protected $EOL = "\n";

    /**
     * formatter
     * @var SMB\Arrayto\Formatter\LtsvFormatter
     */
    private static $formatter;

    /**
     * Create an output content for Ltsv
     * @return string
     */
    protected function createOutputContents()
    {
        $formattedItems = $this->formatterInstance()->format($this->rows);

        $ret = array();
        foreach ($formattedItems as $label => $value) {
            $ret[] = $label . ':' . $value;
        }

        return join("\t", $ret) . $this->EOL;
    }

    /**
     * Return a formatter instance
     * @return SMB\Arrayto\Formatter\LtsvFormatter
     */
    protected function formatterInstance()
    {
        if (static::$formatter === null) {
            static::$formatter = new LtsvFormatter();
        }

        return static::$formatter;
    }

    /**
     * To override the end of line
     * @param string $EOL e.g ) "\r\n"
     * @return this
     */
    public function overrideEOL($EOL)
    {
        $this->EOL = $EOL;
        return $this;
    }
}
