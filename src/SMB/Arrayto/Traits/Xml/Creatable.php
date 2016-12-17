<?php

namespace SMB\Arrayto\Traits\Xml;

use SMB\Arrayto\Traits\Storable;
use SMB\Arrayto\Formatter\ArrayToXml;

/**
 * Xml output content creation
 *
 * @author shimabox.net
 */
trait Creatable
{
    use Storable; // know $this->rows

    /**
     * root element name
     * @var string
     */
    protected $rootElementName = '';

    /**
     * rootElementName setter
     * @param string $name
     * @return this
     */
    public function setRootElementName($name)
    {
        $this->rootElementName = $name;
        return $this;
    }

    /**
     * Set to enable replacing space with underscore.
     * @var boolean
     */
    protected $replaceSpacesByUnderScoresInKeyNames = true;

    /**
     * replaceSpacesByUnderScoresInKeyNames setter
     * @param boolean $bool
     * @return this
     */
    public function setReplaceSpacesByUnderScoresInKeyNames($bool)
    {
        $this->replaceSpacesByUnderScoresInKeyNames = $bool;
        return $this;
    }

    /**
     * The version number of the document as part of the XML declaration
     * @var string
     */
    protected $versionOfXmlDeclaration  = '1.0';

    /**
     * The encoding of the document as part of the XML declaration
     * @var string
     */
    protected $encodingOfXmlDeclaration  = 'UTF-8';

    /**
     * Nicely formats output with indentation and extra space
     * @var boolean
     */
    protected $formatOutput = true;

    /**
     * Nicely formats output with indentation and extra space (setter)
     * @param boolean $toFormatOutput
     */
    public function toFormatOutput($toFormatOutput)
    {
        $this->formatOutput = $toFormatOutput;
        return $this;
    }

    /**
     * formatter
     * @var SMB\Arrayto\Formatter\ArrayToXml
     */
    private static $formatter;

    /**
     * Create an output content for XML
     * @return string
     */
    protected function createOutputContents()
    {
        $dom = $this->formatterInstance()
                    ->forge(
                        $this->rows,
                        $this->rootElementName,
                        $this->replaceSpacesByUnderScoresInKeyNames,
                        $this->versionOfXmlDeclaration,
                        $this->encodingOfXmlDeclaration
                    )->toDom();

        $dom->formatOutput = $this->formatOutput;

        return $dom->saveXML();
    }

    /**
     * Return a formatter instance
     *
     * @return SMB\Arrayto\Formatter\ArrayToXml
     */
    protected function formatterInstance()
    {
        if (static::$formatter === null) {
            static::$formatter = new ArrayToXml([]);
        }

        return static::$formatter;
    }
}
