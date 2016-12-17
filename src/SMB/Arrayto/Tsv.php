<?php

namespace SMB\Arrayto;

/**
 * Tsv Factory
 *
 * @author shimabox.net
 */
class Tsv extends Base
{
    /**
     * factory
     * @return \SMB\Arrayto\Tsv
     */
    public static function factory()
    {
        $self = new static();
        $self->downloader = new Plugins\Tsv\Downloader();
        $self->outputter  = new Plugins\Tsv\Outputter();
        $self->writer     = new Plugins\Tsv\Writer();

        return $self;
    }
}
