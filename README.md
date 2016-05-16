# LaravelVersio

Laravel Versio wrapper for their API. This package will convert all returned data in nice collections and suitable working data.

# Usage

Set up the following variables in your .env file:

```
VERSIO_ID=
VERSIO_PASS=
```

Then you can use the class like this:

```
$versio = new Versio;

$versio->domains()->listActive(); // List all active domains
$versio->domains()->listInactive(); // List all inactive domains
$versio->domains()->listSingle('domain', 'tld'); // List a single domain
$versio->domains()->isFree('domain', 'tld'); // List a free domain
```

More commands are under progress.

# IMPORTANT

Please do not use this package yet in a production enviroment, it has not been finished yet and is bound to change abit.

# TODO:

- Expand with more commands
- Error handling