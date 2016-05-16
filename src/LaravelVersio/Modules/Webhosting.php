<?php

namespace LaravelVersio\Modules;

use LaravelVersio\Core;

class Webhosting extends Core
{
    /**
     * List accounts
     * 
     * @return static
     * @throws \Exception
     */
    public function listAccounts()
    {
        $this->command = 'WebhostingListAccounts';

        $send = $this->send();

        return $send->chunk(22); // ## 22 is the number of indexes it returns by the API
    }
}