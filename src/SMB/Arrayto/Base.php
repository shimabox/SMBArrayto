<?php

namespace SMB\Arrayto;

/**
 * Factory Base
 *
 * @author shimabox.net
 */
abstract class Base
{
    /**
     * Downloader
     * @var \SMB\Arrayto\Interfaces\Downloadable
     */
    protected $downloader;

    /**
     * Outputter
     * @var \SMB\Arrayto\Interfaces\Outputable
     */
    protected $outputter;

    /**
     * Writer
     * @var \SMB\Arrayto\Interfaces\Writable
     */
    protected $writer;

    /**
     * Getter of downloader
     * @return \SMB\Arrayto\Interfaces\Downloadable
     */
    public function getDownloader()
    {
        return $this->downloader;
    }

    /**
     * Getter of outputter
     * @return \SMB\Arrayto\Interfaces\Outputter
     */
    public function getOutputter()
    {
        return $this->outputter;
    }

    /**
     * Getter of writer
     * @return \SMB\Arrayto\Interfaces\Writer
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * Set the row to be written
     * @param array $rows
     * @return \SMB\Arrayto\Base
     */
    public function setRows(array $rows)
    {
        $this->downloader->setRows($rows);
        $this->outputter->setRows($rows);
        $this->writer->setRows($rows);

        return $this;
    }

    /**
     * To add a specified row keys and values
     * @param string $key
     * @param mixed $value
     * @return \SMB\Arrayto\Base
     */
    public function addRowBySpecifyingKV($key, $value)
    {
        $this->downloader->addRowBySpecifyingKV($key, $value);
        $this->outputter->addRowBySpecifyingKV($key, $value);
        $this->writer->addRowBySpecifyingKV($key, $value);

        return $this;
    }

    /**
     * Add the row to be written
     * @param mixed $rows
     * @return \SMB\Arrayto\Base
     */
    public function addRow($rows)
    {
        $this->downloader->addRow($rows);
        $this->outputter->addRow($rows);
        $this->writer->addRow($rows);

        return $this;
    }

    /**
     * Clear row
     * @param mixed $record
     * @return \SMB\Arrayto\Base
     */
    public function clearRows()
    {
        $this->downloader->clearRows();
        $this->outputter->clearRows();
        $this->writer->clearRows();

        return $this;
    }

    /**
     * Whether to allow duplicate keys
     * @param boolean $toAllow
     * @return \SMB\Arrayto\Base
     */
    public function setAllowDuplicateKey($toAllow)
    {
        $this->downloader->setAllowDuplicateKey($toAllow);
        $this->outputter->setAllowDuplicateKey($toAllow);
        $this->writer->setAllowDuplicateKey($toAllow);

        return $this;
    }
}
