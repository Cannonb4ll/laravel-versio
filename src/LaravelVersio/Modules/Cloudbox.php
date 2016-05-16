<?php

namespace LaravelVersio\Modules;

use LaravelVersio\Core;

class Cloudbox extends Core
{
    public function list()
    {
        $this->command = 'CloudboxList';

        $send = $this->send();

        return $send->chunk(7); // ## 7 is the number of indexes it returns by the API
    }
}