<?php

namespace LaravelVersio;

use LaravelVersio\Modules\Cloudbox;
use LaravelVersio\Modules\Dedicated;
use LaravelVersio\Modules\Domain;
use LaravelVersio\Modules\Reseller;
use LaravelVersio\Modules\Ssl;
use LaravelVersio\Modules\Webhosting;

class Versio extends Core
{
    /**
     * @return Domain
     */
    public function domains()
    {
        return new Domain;
    }

    /**
     * @return Cloudbox
     */
    public function cloudbox()
    {
        return new Cloudbox;
    }

    /**
     * @return Webhosting
     */
    public function webhosting()
    {
        return new Webhosting;
    }

    /**
     * @return Reseller
     */
    public function reseller()
    {
        return new Reseller;
    }

    /**
     * @return Ssl
     */
    public function ssl()
    {
        return new Ssl;
    }

    /**
     * @return Dedicated
     */
    public function dedicated()
    {
        return new Dedicated;
    }
}