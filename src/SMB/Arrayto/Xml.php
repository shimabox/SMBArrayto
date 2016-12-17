<?php

namespace SMB\Arrayto;

/**
 * Xml Factory
 *
 * @author shimabox.net
 */
class Xml extends Base
{
    /**
     * factory
     * @return \SMB\Arrayto\Xml
     */
    public static function factory()
    {
        $self = new static();
        $self->downloader = new Plugins\Xml\Downloader();
        $self->writer     = new Plugins\Xml\Writer();
        
        $self->outputter  = new Plugins\NullObject();

        return $self;
    }
}
