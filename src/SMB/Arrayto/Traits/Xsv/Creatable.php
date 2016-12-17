<?php

namespace SMB\Arrayto\Traits\Xsv;

use SMB\Arrayto\Traits\Storable;

/**
 * Csv,Tsv output content creation
 *
 * @author shimabox.net
 */
trait Creatable
{
    use Storable; // know $this->rows

    /**
     * To add a specified row keys and values
     * @param string $key
     * @param mixed $value
     * @return this
     */
    public function addRowBySpecifyingKV($key, $value)
    {
        $this->rows[$key] = $value;
        return $this;
    }

    /**
     * Create an output content
     * @param array $header
     * @param string $delimiter
     * @param string $enclosure
     * @param boolean $toConvert true : LF => CRLF, UTF-8 => SJIS-win, false : LF, UTF-8
     * @return string
     */
    protected function createOutputContents(
        array $header,
        $delimiter = ',',
        $enclosure = '"',
        $toConvert = true
    )
    {
        $fp = fopen("php://temp", 'r+b');

        // header
        if ($header) {
            fputcsv($fp, $header, $delimiter, $enclosure);
        }

        foreach ($this->rows as $row) {
            fputcsv($fp, $row, $delimiter, $enclosure);
        }

        rewind($fp);

        $buffer = stream_get_contents($fp);

        if ($toConvert === false) {
            fclose($fp);
            return $buffer;
        }

        $ret = $this->convert($buffer);

        fclose($fp);

        return $ret;
    }

    /**
     * convert
     * @param string $buffer
     * @return string
     */
    protected function convert($buffer)
    {
        return mb_convert_encoding(
            str_replace("\n", "\r\n", $buffer),
            'SJIS-win',
            'UTF-8'
        );
    }
}
