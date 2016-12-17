<?php

namespace SMB\Arrayto;

/**
 * Csv Factory
 *
 * @author shimabox.net
 */
class Csv extends Base
{
    /**
     * factory
     * @return \SMB\Arrayto\Csv
     */
    public static function factory()
    {
        $self = new static();
        $self->downloader = new Plugins\Csv\Downloader();
        $self->outputter  = new Plugins\Csv\Outputter();
        $self->writer     = new Plugins\Csv\Writer();

        return $self;
    }
}
