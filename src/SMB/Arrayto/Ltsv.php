<?php

namespace SMB\Arrayto;

/**
 * Ltsv Factory
 *
 * @author shimabox.net
 */
class Ltsv extends Base
{
    /**
     * factory
     * @return \SMB\Arrayto\LTsv
     */
    public static function factory()
    {
        $self = new static();
        $self->downloader = new Plugins\Ltsv\Downloader();
        $self->writer     = new Plugins\Ltsv\Writer();

        $self->outputter  = new Plugins\NullObject();

        return $self;
    }
}
