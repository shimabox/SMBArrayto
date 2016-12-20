# SMBArrayto
[![Build Status](https://travis-ci.org/shimabox/SMBArrayto.svg?branch=master)](https://travis-ci.org/shimabox/SMBArrayto)

Array to csv, tsv, ltsv, xml, json, ...

## Overview

- Array to csv, tsv, ltsv, xml, json, ...
- And provides a download function, output function, write function

## Requirements

- PHP 5.4+ or newer
- [Composer](https://getcomposer.org)
- [GitHub - fjyuu/monolog-ltsv-formatter: LTSV Formatter for Monolog](https://github.com/fjyuu/monolog-ltsv-formatter)
- [GitHub - spatie/array-to-xml: A simple class to convert an array to xml](https://github.com/spatie/array-to-xml)

## Installation

```
composer require shimabox/smbarrayto
```

## Basic Usage

### In the case of csv download

- It does not create a temporary file
- Use the header function

```php
<?php
require_once '/your/path/to/vendor/autoload.php';

use SMB\Arrayto;

$header = ['name', '名前', 'price'];

$rows = [
    ['apple', 'りんご', '1,000'],
    ['pineapple', 'パインアップル', '800']
];

// csv
$csv = Arrayto\Csv::factory();

// downloader object
$csvDownloader = $csv->getDownloader();

// download
$csvDownloader->setHeader($header) // optional
              ->setRows($rows) // set the rows
              ->download('example.csv');
exit;
```

or

```php
<?php
require_once '/your/path/to/vendor/autoload.php';

use SMB\Arrayto;

$header = ['name', '名前', 'price'];

// csv
$csv = Arrayto\Csv::factory();

// downloader object
$csvDownloader = $csv->getDownloader();

// download
$csvDownloader->setHeader($header) // optional
              ->addRow(['apple', 'りんご', '1,000']) // add the row
              ->addRow(['pineapple', 'パインアップル', '800']) // add the row
              ->download('example.csv');
exit;
```

#### Result

```csv
name,名前,price
apple,りんご,"1,000"
pineapple,パインアップル,800
```

- The default line feed code ```CRLF``` (only csv, tsv)
- The default encoding ```SJIS-win``` (only csv, tsv)
- Please perform the following if you want to change this
- e.g.)
```php
  // download
  $csvDownloader->setHeader($header)
                ->setRows($rows)
                ->setToConvert(false) // Not carried out the convert
                ->download('example.csv');
  exit;
```
  - Line feed code is ```LF```
  - Encoding is ```UTF-8```

## Example

- Use basically the following three interfaces
  - ```download($fileName);```
    - It does not create a temporary file
    - Use the header function
  - ```output();```
    - It does not create a temporary file
    - Use the header function
    - Simply echo()
  - ```write();```
    - Need to specify the path where you want to save by setFileName()

### In the case of CSV

**download($fileName);**

```php
<?php
use SMB\Arrayto;

$csvHeader = ['name', '名前', 'price'];

$csvRows = [
    ['apple', 'りんご', '1,000'],
    ['pineapple', 'パインアップル', '800']
];

// csv
$csv = Arrayto\Csv::factory();

// downloader object
$csvDownloader = $csv->getDownloader();

// download
$csvDownloader->setHeader($csvHeader)
              ->setRows($csvRows)
              ->download('example.csv');
exit;
```

**output();**

```php
<?php
use SMB\Arrayto;

// csv
$csv = Arrayto\Csv::factory();

// outputter object
$csvOutputter = $csv->getOutputter();

// output
$csvOutputter->setHeader($csvHeader)
             ->setRows($csvRows)
             ->output();
exit;
```

**write();**

```php
<?php
use SMB\Arrayto;

// csv
$csv = Arrayto\Csv::factory();

// writer object
$csvWriter = $csv->getWriter();

// write
$csvWriter->setHeader($csvHeader)
          ->setRows($csvRows)
          ->setFileName('/path/to/your/example.csv') // specify the path
          ->write();
```

### In the case of TSV

- With csv interface

```php
<?php
use SMB\Arrayto;

$header = ['name', '名前', 'price'];

$rows = [
    ['apple', 'りんご', '1,000'],
    ['pineapple', 'パインアップル', '800']
];

// tsv
$tsv = Arrayto\Tsv::factory();

// downloader object
$tsvDownloader = $tsv->getDownloader();

// outputter object
$tsvOutputter = $tsv->getOutputter();

// writer object
$tsvWriter = $tsv->getWriter();
```

#### CSV, TSV configuration

- ``` setHeader(array $header); ```
  - You can set the header row
- ``` clearHeader(); ```
  - You can clear the header row
- ``` setToConvert($toConvert); ```
  - The default is ```true```
    - Convert the line feed code to ```CRLF```
    - To convert the encoding to ```SJIS-win```
  - If you set the ```false```, it does not perform the conversion

### In the case of LTSV

- It depends on [GitHub - fjyuu/monolog-ltsv-formatter: LTSV Formatter for Monolog](https://github.com/fjyuu/monolog-ltsv-formatter)

**download($fileName);**

```php
<?php
use SMB\Arrayto;

$obj = new \stdClass();
$obj->hoge = 123;
$obj->piyo = ['abc' => null, 'def' => false];

$ltsvRows = [
    'time' => "[2017-01-01 08:59:60]",
    'foo' => null,
    'bar' => true,
    'buz' => 0,
    'url' => 'http://example.net',
    'arr' => ['foo' => 'bar'],
    'obj' => $obj
];

// ltsv
$ltsv = Arrayto\Ltsv::factory();

// downloader object
$ltsvDownloader = $ltsv->getDownloader();

// download
$ltsvDownloader->setRows($ltsvRows)
               ->download('example.log');
exit;
```

**Result**

```
time:[2017-01-01 08:59:60]<TAB>foo:NULL<TAB>bar:true<TAB>buz:0<TAB>url:http://example.net<TAB>arr:{"foo":"bar"}<TAB>obj:[object] (stdClass: {"hoge":123,"piyo":{"abc":null,"def":false}})
```

**output();**

- **It does nothing**

**write();**

```php
<?php
use SMB\Arrayto;

// ltsv
$ltsv = Arrayto\Ltsv::factory();

// writer object
$ltsvWriter = $ltsv->getWriter();

// write
$ltsvWriter->setRows($ltsvRows)
           ->setFileName('/path/to/your/example.log') // specify the path
           ->write();
```

#### LTSV configuration

- ``` overrideEOL($EOL); ```
  - You can override the line feed code
  - The default line feed code is ``` \n (LF) ```
  - e.g.)
  ```php
  // write
  $ltsvWriter->setRows($ltsvRows)
             ->setFileName('/path/to/your/example.log')
             ->overrideEOL("\r\n") // CRLF
             ->write();
  ```

### In the case of XML

- It depends on [GitHub - spatie/array-to-xml: A simple class to convert an array to xml](https://github.com/spatie/array-to-xml)

**download($fileName);**

```php
<?php
use SMB\Arrayto;

$xmlRows['book'] = [
    [
        '_attributes' => ['category' => 'children', 'currency' => 'USD'],
        'tilte' => [
            '_attributes' => ['lang' => 'en'],
            '_value' => 'Harry Potter'
        ],
        'author' => 'J K. Rowling',
        'year' => 2005,
        'price' => 29.99
    ],
    [
        '_attributes' => ['category' => 'music', 'currency' => 'JPY'],
        'tilte' => [
            '_attributes' => ['lang' => 'ja'],
            '_value' => '[score] Boys&Gilrs'
        ],
        'author' => 'GOING STEADY(銀杏BOYZ)',
        'year' => 2000,
        'price' => "2,808"
    ]
];

// xml
$xml = Arrayto\Xml::factory();

// downloader object
$xmlDownloader = $xml->getDownloader();

// download
$xmlDownloader->setRows($xmlRows)
              ->setRootElementName('bookstore') // optional
              ->download('example.xml');
exit;
```

**Result**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<bookstore>
  <book category="children" currency="USD">
    <tilte lang="en">Harry Potter</tilte>
    <author>J K. Rowling</author>
    <year>2005</year>
    <price>29.99</price>
  </book>
  <book category="music" currency="JPY">
    <tilte lang="ja">[score] Boys&amp;Gilrs</tilte>
    <author>GOING STEADY(銀杏BOYZ)</author>
    <year>2000</year>
    <price>2,808</price>
  </book>
</bookstore>
```

**output();**

- **It does nothing**

**write();**

```php
<?php
use SMB\Arrayto;

// xml
$xml = Arrayto\Xml::factory();

// writer object
$xmlWriter = $xml->getWriter();

// write
$xmlWriter->setRows($xmlRows)
          ->setRootElementName('bookstore') // optional
          ->setFileName('/path/to/your/example.xml') // specify the path
          ->write();
```

#### XML configuration

- ``` setRootElementName($name); ```
  - You can set the root element name
  - Default of the root element name is the ```root```
- ``` setReplaceSpacesByUnderScoresInKeyNames($bool); ```
  - Set to enable replacing space with underscore
  - The default is ```true```
- ``` toFormatOutput($toFormatOutput); ```
  - Nicely formats output with indentation and extra space
  - The default is ```true```
  - If you set the ```false```, it does not format
  - e.g.)
  ```php
    $xmlWriter->setRows($xmlRows)
              ->setRootElementName('bookstore') // optional
              ->setFileName('example.xml') // specify the path
              ->toFormatOutput(false) // it does not format
              ->write();
  ```
  **Result**
  ```xml
<?xml version="1.0" encoding="UTF-8"?>
<bookstore><book category="children" currency="USD"><tilte lang="en">Harry Potter</tilte><author>J K. Rowling</author><year>2005</year><price>29.99</price></book><book category="music" currency="JPY"><tilte lang="ja">[score] Boys&amp;Gilrs</tilte><author>GOING STEADY(銀杏BOYZ)</author><year>2000</year><price>2,808</price></book></bookstore>
  ```

### In the case of Json

**download($fileName)**

```php
<?php
use SMB\Arrayto;

$obj = new \stdClass();
$obj->hoge = '123';
$obj->piyo = ['abc' => null, 'def' => false];

$jsonRows = [
    ['key1' => null, 'key2' => true, 'key3' => 0],
    ['url' => 'http://example.net'],
    ['arr' => ['foo' => 'bar']],
    ['obj' => $obj]
];

// json
$json = Arrayto\Json::factory();

// downloader object
$jsonDownloader = $json->getDownloader();

// download
$jsonDownloader->setRows($jsonRows)
               ->download('example.json');
exit;
```

**Result**

```json
[
    {
        "key1": null,
        "key2": true,
        "key3": 0
    },
    {
        "url": "http://example.net"
    },
    {
        "arr": {
            "foo": "bar"
        }
    },
    {
        "obj": {
            "hoge": "123",
            "piyo": {
                "abc": null,
                "def": false
            }
        }
    }
]
```

**output();**

```php
<?php
use SMB\Arrayto;

// json
$json = Arrayto\Json::factory();

// outputter object
$jsonOutputter = $json->getOutputter();

// output
$jsonOutputter->setRows($jsonRows)
              ->output();
exit;
```

**write();**

```php
<?php
use SMB\Arrayto;

// json
$json = Arrayto\Json::factory();

// writer object
$jsonWriter = $json->getWriter();

// write
$jsonWriter->setRows($jsonRows)
           ->setFileName('/path/to/your/example.json') // specify the path
           ->write();
```

#### JSON configuration

- ``` setJsonEncodeOption($option); ```
  - You can override the json_encode options
    - [PHP: json_encode - Manual](http://php.net/manual/en/function.json-encode.php "PHP: json_encode - Manual") - options
  - The default is ```448 (JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)```
  - e.g.)
  ```php
    $jsonWriter->setRows($jsonRows)
               ->setFileName('/path/to/your/example.json') // specify the path
               ->setJsonEncodeOption(JSON_FORCE_OBJECT) // override
               ->write();
  ```
  **Result**
  ```json
    {"0":{"key1":null,"key2":true,"key3":0},"1":{"url":"http:\/\/example.net"},"2":{"arr":{"foo":"bar"}},"3":{"obj":{"hoge":"123","piyo":{"abc":null,"def":false}}}}
  ```

### Other functions of the Downloader

- ``` downloadExistsFile($fileName, $aliasOfFileName = ''); ```
  - Download an existing file
  ```php
    <?php
    use SMB\Arrayto;

    // csv
    $csv = Arrayto\Csv::factory();

    // downloader object
    $csvDownloader = $csv->getDownloader();

    // download an existing file
    $csvDownloader->downloadExistsFile('/path/to/your/example.csv'); // file name is example.csv

    // or download an existing file as an alias
    $csvDownloader->downloadExistsFile('/path/to/your/example.csv', 'sample.csv'); // file name is sample.csv

    exit;
  ```
- ``` downloadExistsFileUsingWriter($fileName, Writable $writer); ```
  - Download an existing file using Writer
  - Download after the writing of the file
  ```php
    <?php
    use SMB\Arrayto;

    $rows = [
        ['apple', 'りんご', '1,000'],
        ['pineapple', 'パインアップル', '800']
    ];

    // csv
    $csv = Arrayto\Csv::factory();

    // writer object
    $csvWriter = $csv->getWriter()
                     ->setRows($rows)
                     ->setFileName('/path/to/your/example.csv'); // specify the path

    // downloader object
    $csvDownloader = $csv->getDownloader();

    // download after the writing of the file
    $csvDownloader->downloadExistsFileUsingWriter('sample.csv', $csvWriter); // file name is sample.csv

    exit;
  ```

### Configuration

@see ``` SMB\Arrayto\Traits\Storable　```

- ``` addRow($row); ```
  - Add the row
  ```php
  use SMB\Arrayto;

  $obj = new \stdClass();
  $obj->hoge = '123';
  $obj->piyo = ['abc' => null, 'def' => false];

  // json
  $json = Arrayto\Json::factory();

  // write
  $json->getWriter()
	   ->addRow(['key1' => null, 'key2' => true, 'key3' => 0])
       ->addRow(['url' => 'http://example.net'])
       ->addRow(['arr' => ['foo' => 'bar']])
       ->addRow(['obj' => $obj])
       ->setFileName('/path/to/your/example.json')
       ->write();
  ```
  **Result**
  ```json
  [
      {
          "key1": null,
          "key2": true,
          "key3": 0
      },
      {
          "url": "http://example.net"
      },
      {
          "arr": {
              "foo": "bar"
          }
      },
      {
          "obj": {
              "hoge": "123",
              "piyo": {
                  "abc": null,
                  "def": false
              }
          }
      }
  ]
  ```
- ``` addRowBySpecifyingKV($key, $value); ```
  - To add a specified row keys and values
  ```php
    <?php
    use SMB\Arrayto;

    $obj = new \stdClass();
    $obj->hoge = '123';
    $obj->piyo = ['abc' => null, 'def' => false];

    $obj2 = new \stdClass();
    $obj2->hoge = '456';
    $obj2->piyo = ['ghi' => null, 'jkl' => false];

    // json
    $json = Arrayto\Json::factory();

    // write
    $json->getWriter()
         ->addRowBySpecifyingKV('url', 'http://example.net')
         ->addRowBySpecifyingKV('url', 'http://example.org')
         ->addRowBySpecifyingKV('arr', ['foo' => 'bar'])
         ->addRowBySpecifyingKV('arr', ['baz' => 'fuga'])
         ->addRowBySpecifyingKV('obj', $obj)
         ->addRowBySpecifyingKV('obj', $obj2)
         ->setFileName('/path/to/your/example.json')
         ->write();
  ```
  **Result**
  ```json
    {
        "url": [
            "http://example.net",
            "http://example.org"
        ],
        "arr": [
            {
                "foo": "bar"
            },
            {
                "baz": "fuga"
            }
        ],
        "obj": [
            {
                "hoge": "123",
                "piyo": {
                    "abc": null,
                    "def": false
                }
            },
            {
                "hoge": "456",
                "piyo": {
                    "ghi": null,
                    "jkl": false
                }
            }
        ]
    }
  ```
- ``` setAllowDuplicateKey($toAllow); ```
  - Whether set to allow duplicate keys
  - The default is ```true```
    - csv,tsv behaves as false
  - If you set the ```false```, it does not allow duplicate keys
  - e.g.)
  ```php
    <?php
    use SMB\Arrayto;

    $obj = new \stdClass();
    $obj->hoge = '123';
    $obj->piyo = ['abc' => null, 'def' => false];

    $obj2 = new \stdClass();
    $obj2->hoge = '456';
    $obj2->piyo = ['ghi' => null, 'jkl' => false];

    // json
    $json = Arrayto\Json::factory();

    // write
    $json->getWriter()
         ->setAllowDuplicateKey(false) // it does not allow duplicate keys
         ->addRowBySpecifyingKV('url', 'http://example.net')
         ->addRowBySpecifyingKV('url', 'http://example.org')
         ->addRowBySpecifyingKV('arr', ['foo' => 'bar'])
         ->addRowBySpecifyingKV('arr', ['baz' => 'fuga'])
         ->addRowBySpecifyingKV('obj', $obj)
         ->addRowBySpecifyingKV('obj', $obj2)
         ->setFileName('/path/to/your/example.json')
         ->write();
  ```
  **Result**
  ```json
    {
        "url": "http://example.org",
        "arr": {
            "baz": "fuga"
        },
        "obj": {
            "hoge": "456",
            "piyo": {
                "ghi": null,
                "jkl": false
            }
        }
    }
  ```

### Configuration for write

@see ``` SMB\Arrayto\Traits\File```

- ``` setFileName($fileName); ```
  - Specify where to save the file path (is a required value)
  - ``` '/path/to/your/example.csv' ``` or ``` '../example.csv' ``` or ``` 'example.csv' ``` ...
- ``` setOpenMode($mode); ```
  - Specify the open mode of the file
  - The default open mode is ``` w ```
  - [PHP: fopen - Manual](http://php.net/manual/en/function.fopen.php "PHP: fopen - Manual") - A list of possible modes for fopen()
  - e.g.)
  ```php
    <?php
    use SMB\Arrayto;

    $header = ['name', '名前', 'feature'];

    $rows1 = [
        ['apple', 'りんご', "Sweet\tRed"]
    ];

    // tsv
    $tsv = Arrayto\Tsv::factory();

    // writer object
    $tsvWriter = $tsv->getWriter();

    $tsvWriter->setHeader($header)
              ->setRows($rows1)
              ->setFileName('/path/to/your/example.tsv')
              ->write();

    $rows2 = [
        ['pineapple', 'パインアップル', "Sour\tYellow"]
    ];
    $tsvWriter->clearHeader()
             ->setRows($rows2)
             ->setOpenMode('a') // set open mode 'a'
             ->write();

    $rows3 = [
        ['orange', 'オレンジ', "Juicy\tOrange"]
    ];
    $tsvWriter->setRows($rows3)
              ->write();
  ```
  **Result**
  ```tsv
    name<TAB>名前<TAB>feature
    apple<TAB>りんご<TAB>"Sweet<TAB>Red"
    pineapple<TAB>パインアップル<TAB>"Sour<TAB>Yellow"
    orange<TAB>オレンジ<TAB>"Juicy<TAB>Orange"
  ```
- ``` setPermission($permission); ```
  - You can set the file permissions
  - The default permission is ```666```
  - e.g.)
  ```php
    $csvWriter->setRows($rows)
              ->setPermission(777) // set the permissions to 777
              ->write();
  ```

### Other methods of instantiation

- ``` Arrayto::factory(XXX); ```
```php
  <?php
  use SMB\Arrayto;

  $csv = Arrayto::factory(Arrayto::CSV);   // => SMB\Arrayto\Csv
  // $csv == Arrayto\Csv::factory();

  $tsv = Arrayto::factory(Arrayto::TSV);   // => SMB\Arrayto\Tsv
  // $tsv == Arrayto\Tsv::factory();

  $ltsv = Arrayto::factory(Arrayto::LTSV); // => SMB\Arrayto\Ltsv
  // $ltsv == Arrayto\Ltsv::factory();

  $xml = Arrayto::factory(Arrayto::XML);   // => SMB\Arrayto\Xml
  // $xml == Arrayto\Xml::factory();

  $json = Arrayto::factory(Arrayto::JSON); // => SMB\Arrayto\Json
  // $json == Arrayto\Json::factory();
```
- ``` Arrayto\Plugins\XXX\XXX ```
```php
  <?php
  use SMB\Arrayto;

  $csvDownloader = new Arrayto\Plugins\Csv\Downloader();
  // $csvDownloader == Arrayto\Csv::factory()->getDownloader();
  $csvOutputter = new Arrayto\Plugins\Csv\Outputter();
  // $csvOutputter == Arrayto\Csv::factory()->getOutputter();
  $csvWriter = new Arrayto\Plugins\Csv\Writer();
  // $csvWriter == Arrayto\Csv::factory()->getWriter();

  $tsvDownloader = new Arrayto\Plugins\Tsv\Downloader();
  // $tsvDownloader == Arrayto\Tsv::factory()->getDownloader();
  $tsvOutputter = new Arrayto\Plugins\Tsv\Outputter();
  // $tsvOutputter == Arrayto\Tsv::factory()->getOutputter();
  $tsvWriter = new Arrayto\Plugins\Tsv\Writer();
  // $tsvWriter == Arrayto\Tsv::factory()->getWriter();

  $ltsvDownloader = new Arrayto\Plugins\Ltsv\Downloader();
  // $ltsvDownloader == Arrayto\Ltsv::factory()->getDownloader();
  $ltsvWriter = new Arrayto\Plugins\Ltsv\Writer();
  // $ltsvWriter == Arrayto\Ltsv::factory()->getWriter();

  $xmlDownloader = new Arrayto\Plugins\Xml\Downloader();
  // $xmlDownloader == Arrayto\Xml::factory()->getDownloader();
  $xmlWriter = new Arrayto\Plugins\Xml\Writer();
  // $xmlWriter == Arrayto\Xml::factory()->getWriter();

  $jsonDownloader = new Arrayto\Plugins\Json\Downloader();
  // $jsonDownloader == Arrayto\Json::factory()->getDownloader();
  $jsonOutputter = new Arrayto\Plugins\Json\Outputter();
  // $jsonOutputter == Arrayto\Json::factory()->getOutputter();
  $jsonWriter = new Arrayto\Plugins\Json\Writer();
  // $jsonWriter == Arrayto\Json::factory()->getWriter();
```

## Testing

```
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
