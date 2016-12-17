<?php

namespace SMB\Arrayto\Traits;

/**
 * Can store in a row
 *
 * @author shimabox.net
 */
trait Storable
{
    /**
     * rows
     * @var array
     */
    private $rows = [];
    
    /**
     * Whether to allow duplicate keys
     * @var boolean
     */
    private $allowDuplicateKey = true;
    
    /**
     * Setter of rows
     * @param array $row
     * @return this
     */
    public function setRows(array $row)
    {
        $this->rows = $row;
        return $this;
    }
    
    /**
     * To add a specified row keys and values
     * @param string $key
     * @param mixed $value
     * @return this
     */
    public function addRowBySpecifyingKV($key, $value)
    {
        if ($this->allowDuplicateKey === true) {
            $this->rows[$key][] = $value;
        } else {
            $this->rows[$key] = $value;
        }
        
        return $this;
    }
    
    /**
     * Add the row to be written
     * @param mixed $row
     * @return this
     */
    public function addRow($row)
    {
        $this->rows[] = $row;
        return $this;
    }
    
    /**
     * Getter of the rows
     * @return array $record
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Clear rows
     * @param mixed $record
     * @return this
     */
    public function clearRows()
    {
        $this->rows = [];
        return $this;
    }

    /**
     * Whether set to allow duplicate keys
     * @param boolean $toAllow
     * @return this
     */
    public function setAllowDuplicateKey($toAllow)
    {
        $this->allowDuplicateKey = $toAllow;
        return $this;
    }
}
