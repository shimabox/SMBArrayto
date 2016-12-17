<?php

namespace SMB\Arrayto\Formatter;

use Spatie\ArrayToXml\ArrayToXml as SpatieArrayToXml;
use DOMElement;
use DOMDocument;
use DOMException;

/**
 * Array To Xml
 *
 * @author shimabox.net
 */
class ArrayToXml extends SpatieArrayToXml
{
    /**
     * Construct a new instance.
     *
     * @param string[] $array
     * @param string   $rootElementName
     * @param bool     $replaceSpacesByUnderScoresInKeyNames
     *
     * @throws DOMException
     */
    public function __construct(array $array, $rootElementName = '', $replaceSpacesByUnderScoresInKeyNames = true)
    {
        // do nothing
    }

    /**
     * forge ArrayToXml
     * @param string[] $array
     * @param string   $rootElementName
     * @param bool     $replaceSpacesByUnderScoresInKeyNames
     * @param string   $version Version of the XML declaration
     * @param string   $encoding encoding of the XML declaration.
     * @throws DOMException
     * @return \SMB\Arrayto\Formatter\ArrayToXml
     * @see Spatie\ArrayToXml\ArrayToXml
     */
    public function forge(
        array $array,
        $rootElementName = '',
        $replaceSpacesByUnderScoresInKeyNames = true,
        $version = '1.0',
        $encoding = 'UTF-8'
    )
    {
        $this->document = new DOMDocument($version, $encoding);
        $this->replaceSpacesByUnderScoresInKeyNames = $replaceSpacesByUnderScoresInKeyNames;

        if ($this->isArrayAllKeySequential($array) && ! empty($array)) {
            throw new DOMException('Invalid Character Error');
        }

        $root = $this->document->createElement($rootElementName == '' ? 'root' : $rootElementName);

        $this->document->appendChild($root);

        $this->_convertElement($root, $array);

        return $this;
    }

    /**
     * Parse individual element.
     *
     * @param DOMElement     $element
     * @param string|string[] $value
     */
    private function _convertElement(DOMElement $element, $value)
    {
        $sequential = $this->isArrayAllKeySequential($value);

        if (!is_array($value)) {
            $element->nodeValue = htmlspecialchars($value);

            return;
        }

        foreach ($value as $key => $data) {
            if (!$sequential) {
                if ($key === '_attributes') {
                    $this->addAttributes($element, $data);
                } elseif ($key === '_value' && is_string($data)) {
                    $element->nodeValue = htmlspecialchars($data);
                } else {
                    $this->addNode($element, $key, $data);
                }
            } elseif (is_array($data)) {
                $this->addCollectionNode($element, $data);
            } else {
                $this->addSequentialNode($element, $data);
            }
        }
    }
}
