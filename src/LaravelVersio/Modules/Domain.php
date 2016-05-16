<?php

namespace LaravelVersio\Modules;

use LaravelVersio\Core;

class Domain extends Core{

    /**
     * List active domains
     *
     * @return static
     */
    public function listActive()
    {
        $this->command = 'DomainsListActive';

        $send = $this->send();

        return $send->chunk(22); // ## 22 is the number of indexes it returns by the API
    }

    /**
     * List inactive domains
     *
     * @return static
     */
    public function listInactive()
    {
        $this->command = 'DomainsListInactive';

        $send = $this->send();

        return $send->chunk(22); // ## 22 is the number of indexes it returns by the API
    }

    /**
     * List a single domain
     *
     * @param null $domain
     * @param null $tld
     * @return mixed
     * @throws \Exception
     */
    public function listSingle($domain = null, $tld = null)
    {
        $this->command = 'DomainsListSingle';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;

        $send = $this->send();

        return $send->chunk(23)->first(); // ## 23 is the number of indexes it returns by the API
    }

    /**
     * Check if domain is free
     *
     * @param null $domain
     * @param null $tld
     * @return array|Collection
     * @throws \Exception
     */
    public function isFree($domain = null, $tld = null)
    {
        $this->command = 'DomainsCheckAvailability';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;

        $send = $this->send();

        return $send;
    }

    public function setNameservers($domain = null, $tld = null, $nameservers = [])
    {
        $this->command = 'DomainsCheckAvailability';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;

        foreach($nameservers as $key => $nameserver){
            $this->options[$key] = $nameserver;
        }

        $send = $this->send();

        return $send;
    }

    /**
     * List DNS records for domain
     *
     * @param null $domain
     * @param null $tld
     * @return static
     * @throws \Exception
     */
    public function dnsRecords($domain = null, $tld = null)
    {
        $this->command = 'DomainsDNSListRecords';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;

        $send = $this->send();

        return $send->chunk(6);
    }

    /**
     * Switch DNS on/off
     *
     * @param null $domain
     * @param null $tld
     * @param bool $state TRUE = DNS on | FALSE = DNS OFF
     * @return array|Collection
     * @throws \Exception
     */
    public function switchDns($domain = null, $tld = null, $state = false)
    {
        if($state) {
            $this->command = 'DomainsDNSOn';
        }else{
            $this->command = 'DomainsDNSOff';
        }

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;

        $this->send();

        return $this->success ? true : false;
    }
}