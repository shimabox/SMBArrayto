<?php

namespace SMB\Arrayto\Traits\Xsv;

/**
 * Csv,Tsv option setting
 *
 * @author shimabox.net
 */
trait Configurable
{
    /**
     * header row
     * @var array
     */
    protected $header = [];

    /**
     * Delimiter for csv
     * @var array
     */
    protected $delimiter4Csv = ',';

    /**
     * Delimiter for tsv
     * @var array
     */
    protected $delimiter4Tsv = "\t";

    /**
     * Enclosure character
     * @var string
     */
    protected $enclosure = '"';

    /**
     * Whether or not to convert a string<br>
     * LF => CRLF, UTF-8 => SJIS-win, false : LF, UTF-8
     * @var boolean
     */
    protected $toConvert = true;

    /**
     * Setter of header row
     * @param array $header
     * @return this
     */
    public function setHeader(array $header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Clear the header row
     * @param array $header
     * @return this
     */
    public function clearHeader()
    {
        $this->header = [];
        return $this;
    }

    /**
     * Whether or not to convert a string (setter)<br>
     * LF => CRLF, UTF-8 => SJIS-win, false : LF, UTF-8
     * @param boolean $toConvert
     * @return this
     */
    public function setToConvert($toConvert)
    {
        $this->toConvert = $toConvert;
        return $this;
    }

    /**
     * It returns the Header of charset
     * @return string
     */
    protected function getHeaderCharset()
    {
        return $this->toConvert ? 'SJIS-win' : 'UTF-8';
    }
}
