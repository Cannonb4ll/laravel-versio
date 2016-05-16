<?php

namespace LaravelVersio\Modules;

use LaravelVersio\Core;

class Reseller extends Core
{
    public function listAccounts()
    {
        $this->command = 'ResellerListAccounts';

        $send = $this->send();

        return $send->chunk(22); // ## 22 is the number of indexes it returns by the API
    }
}