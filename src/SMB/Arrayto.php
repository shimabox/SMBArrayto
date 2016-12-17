<?php

namespace SMB;

use SMB\Arrayto;

/**
 * Factory
 *
 * PHP version 5 >= 5.4
 *
 * @author  shimabox.net
 */
class Arrayto
{
    /**
     * @var string
     */
    const JSON = 'json';

    /**
     * @var string
     */
    const CSV = 'csv';

    /**
     * @var string
     */
    const TSV = 'tsv';
    
    /**
     * @var string
     */
    const LTSV = 'ltsv';
    
    /**
     * @var string
     */
    const XML = 'xml';
    
    /**
     * Json
     * @var \SMB\Arrayto\Json
     */
    protected $json;
    
    /**
     * Csv
     * @var \SMB\Arrayto\Csv
     */
    protected $csv;
    
    /**
     * Tsv
     * @var \SMB\Arrayto\Tsv
     */
    protected $tsv;
    
    /**
     * Ltsv
     * @var \SMB\Arrayto\Ltsv
     */
    protected $ltsv;
    
    /**
     * Xml
     * @var \SMB\Arrayto\Xml
     */
    protected $xml;
    
    /**
     * factory
     * @param string $type
     * @return \SMB\Arrayto\Base
     * @throws \InvalidArgumentException
     */
    public static function factory($type)
    {
        switch ($type) {
            case self::JSON:
                return Arrayto\Json::factory();
            case self::CSV:
                return Arrayto\Csv::factory();
            case self::TSV:
                return Arrayto\Tsv::factory();
            case self::LTSV:
                return Arrayto\Ltsv::factory();
            case self::XML:
                return Arrayto\Xml::factory();
        }

        throw new \InvalidArgumentException();
    }
}
