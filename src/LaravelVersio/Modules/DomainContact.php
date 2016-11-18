<?php

namespace LaravelVersio\Modules;

use LaravelVersio\Core;

class DomainContact extends Core
{
    public function create($data = [])
    {
        $this->command = 'DomainsCreateContact';

        $data = collect($data);

        $this->options['initials'] = $data->get('initials');
        $this->options['surname'] = $data->get('surname');
        $this->options['email'] = $data->get('email');
        $this->options['phone'] = $data->get('phone');
        $this->options['street'] = $data->get('street');
        $this->options['hnr'] = $data->get('hnr');
        $this->options['hnradd'] = $data->get('hnradd');
        $this->options['zipcode'] = $data->get('zipcode');
        $this->options['city'] = $data->get('city');
        $this->options['country'] = $data->get('country');

        return $this->send();
    }
}