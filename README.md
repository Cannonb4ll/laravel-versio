# LaravelVersio

Laravel Versio wrapper for their API. This package will convert all returned data in nice collections and suitable working data.

## Installation

```
composer require cannonb4ll/laravel-versio
```

## Usage

Set up the following variables in your .env file:

```
VERSIO_ID=
VERSIO_PASS=
```

Then you can use the class like this:

```
use LaravelVersio\Versio;

$versio = new Versio;

// Enable sandbox mode like this:

$versio->sandboxMode(true);
```

## Commands:

```
- $versio->domains()->register('domain', 'tld', ['ns1.domain.com', 'ns2.domain.com'], $contactId, $years = 1, $park = 0); // Register a domain, $contactId is required!
- $versio->domain_contacts()->create([
    'initials', // REQUIRED
    'surname', // REQUIRED
    'email', // REQUIRED
    'phone', // REQUIRED
    'street', // REQUIRED
    'hnr', // REQUIRED
    'hnradd',
    'zipcode', // REQUIRED
    'city', // REQUIRED
    'country' // REQUIRED (Syntax: NL, BE, UK etc)
]); // Create a domain contact, returns contact ID if succesfull.
- $versio->domains()->listActive(); // List active domains
- $versio->domains()->listInactive(); // List inactive domains
- $versio->domains()->listSingle('domain', 'tld'); // List a single domain
- $versio->domains()->isFree('domain', 'tld'); // Check if domain is free
- $versio->domains()->updateNameservers('domain', 'tld', $array); // Updates domain nameservers, array structure:
$nameservers = [
    'ns1' => 'ns1.website.com',
    'ns2' => 'ns2.website.com'
];

- $versio->domains()->dnsRecords('domain', 'tld'); // List all DNS records
- $versio->domains()->storeDnsRecord('domain', 'tld', $array); // Store a new DNS record, returns record id, array structure:
[
    'name' => 'test',
    'type' => 'A',
    'value' => '123.123.123.123',
    'prio' => 10,
    'ttl' => 300
]
- $versio->domains()->destroyDnsRecord('domain', 'tld', $record_id); // Destroy a DNS record, pass record ID as 3rth argument
- $versio->domains()->switchDns('domain', 'tld', true/false); // Switch DNS management/nameserver management, 3rth argument bool
```

More commands are under progress.

## IMPORTANT

Please do not use this package yet in a production enviroment, it has not been finished yet and is bound to change abit.

## TODO:

- Expand with more commands
- Error handling