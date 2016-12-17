<?php

namespace SMB\Arrayto\Traits;

/**
 * File operation
 *
 * @author shimabox.net
 */
trait File
{
    /**
     * Open mode of the file
     * @var string
     */
    protected $openMode = 'w';

    /**
     * Permission at the time of writing
     * @var int
     */
    protected $permission = 666;
    
    /**
     * file name
     * @var string
     */
    private $fileName = '';
    
    /**
     * Setter of the file name
     * @param string
     * @return this
     */
    public function setFileName($fileName) {
        $this->fileName = $fileName;
        return $this;
    }
    
    /**
     * Getter of the file name
     * @return string
     */
    public function getFileName() {
        return $this->fileName;
    }
    
    /**
     * Setter of the open mode
     * @param string
     * @return this
     */
    public function setOpenMode($mode) {
        $this->openMode = $mode;
        return $this;
    }

    /**
     * Setter of permission
     * @param int $permission
     * @return this
     */
    public function setPermission($permission)
    {
        $this->permission = (int)$permission;
        return $this;
    }

    /**
     * Getter of permission
     * @return int
     */
    protected function getPermission()
    {
        return octdec(sprintf("%04d", $this->permission));
    }

    /**
     * save
     * @param string $contents
     */
    protected function save($contents)
    {
        $fp = fopen($this->fileName, $this->openMode);
        fwrite($fp, $contents);
        fclose($fp);

        chmod($this->fileName, $this->getPermission());
    }
}
