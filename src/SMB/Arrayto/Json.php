<?php

namespace SMB\Arrayto;

/**
 * Json Factory
 *
 * @author shimabox.net
 */
class Json extends Base
{
    /**
     * factory
     * @return \SMB\Arrayto\Json
     */
    public static function factory()
    {
        $self = new static();
        $self->downloader = new Plugins\Json\Downloader();
        $self->outputter  = new Plugins\Json\Outputter();
        $self->writer     = new Plugins\Json\Writer();

        return $self;
    }
}
