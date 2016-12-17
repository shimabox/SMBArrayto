<?php

namespace SMB\Arrayto\Formatter;

use Hikaeme\Monolog\Formatter\LtsvFormatter as HikaemeMonologFormatterLtsvFormatter;

/**
 * Format To Ltsv
 *
 * @author shimabox.net
 */
class LtsvFormatter extends HikaemeMonologFormatterLtsvFormatter
{
    /**
     * {@inheritdoc}
     */
    public function format(array $record)
    {
        return $this->normalizeRecord($record);
    }
}
