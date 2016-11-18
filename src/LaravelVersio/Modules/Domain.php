<?php

namespace LaravelVersio\Modules;

use LaravelVersio\Core;

class Domain extends Core
{
    public function register($domain = null, $tld = null, $nameservers = [], $contactId)
    {
        $this->command = 'DomainsRegister';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;
        $this->options['contact_id'] = $contactId;

        foreach($nameservers as $key => $nameserver){
            $this->options['ns' . ($key + 1)] = $nameserver;
        }

        return $this->send();
    }

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
     * @param string $domain
     * @param string $tld
     * @return mixed
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
     * @param string $domain
     * @param string $tld
     * @return array|Collection
     */
    public function isFree($domain = null, $tld = null)
    {
        $this->command = 'DomainsCheckAvailability';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;

        $send = $this->send();

        return $send;
    }

    /**
     * Update nameservers for a domain
     *
     * @param string $domain
     * @param string $tld
     * @param array $nameservers
     * @return array|\Illuminate\Support\Collection
     */
    public function updateNameservers($domain = null, $tld = null, array $nameservers = [])
    {
        $this->command = 'DomainsCheckAvailability';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;

        foreach ($nameservers as $key => $nameserver) {
            $this->options[$key] = $nameserver;
        }

        return $this->send();
    }

    /**
     * List DNS records for domain
     *
     * @param string $domain
     * @param string $tld
     * @return static
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
     * Add a DNS record
     *
     * @param string $domain
     * @param string $tld
     * @param array $data
     * @return string record_id
     */
    public function storeDnsRecord($domain, $tld, array $data = [])
    {
        $this->command = 'DomainsDNSAddRecord';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;
        $this->options['name'] = $data['name'];
        $this->options['type'] = $data['type'];
        $this->options['value'] = $data['value'];
        $this->options['prio'] = $data['prio'];
        $this->options['ttl'] = $data['ttl'];

        $send = $this->send();

        return $send->get('record_id');
    }

    /**
     * Destroy a DNS record
     *
     * @param string $domain
     * @param string $tld
     * @param integer $record_id
     * @return array|\Illuminate\Support\Collection
     */
    public function destroyDnsRecord($domain, $tld, $record_id)
    {
        $this->command = 'DomainsDNSDeleteRecord';

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;
        $this->options['id'] = $record_id;

        $send = $this->send();

        return $send;
    }

    /**
     * Switch DNS on/off
     *
     * @param string $domain
     * @param string $tld
     * @param bool $state TRUE = DNS on | FALSE = DNS OFF
     * @return array|Collection
     */
    public function switchDns($domain = null, $tld = null, bool $state = false)
    {
        if ($state) {
            $this->command = 'DomainsDNSOn';
        } else {
            $this->command = 'DomainsDNSOff';
        }

        $this->options['domain'] = $domain;
        $this->options['tld'] = $tld;

        $this->send();

        return $this->success ? true : false;
    }
}