# OpenEuropa CDT Client
[![Build Status](https://drone.fpfis.eu/api/badges/openeuropa/cdt-client/status.svg)](https://drone.fpfis.eu/openeuropa/cdt-client)
[![Packagist](https://img.shields.io/packagist/v/openeuropa/cdt-client.svg)](https://packagist.org/packages/openeuropa/cdt-client)

## Description

_CDT Client_ is a library offering a PHP API to consume Translation Centre For the Bodies of the EU services.

## Install

Use [Composer](https://getcomposer.org/) to install the package:

```bash
$ composer require openeuropa/cdt-client
```

## Usage

All calls should be done by instantiating the client class:

```php
require_once 'vendor/autoload.php';

$client = new \OpenEuropa\CdtClient\ApiClient(
    new \GuzzleHttp\Client(),
    new \Http\Factory\Guzzle\RequestFactory(),
    new \Http\Factory\Guzzle\StreamFactory(),
    new \Http\Factory\Guzzle\UriFactory(),
    [
        // For a full list of options see "Configuration".
        'mainApiEndpoint' => 'https://example.com/v2/CheckConnection',
        'tokenApiEndpoint' => 'https://example.com//token',
        'referenceDataApiEndpoint' => 'https://example.com/v2/requests/businessReferenceData',
        'username' => 'your-user-name',
        'password' => 'your-password',
        'client' => 'client-name',
    ]
);
```

In the above example, we're passing the Guzzle HTTP client, request, stream and URI factories. But these can be replaced by any similar factories that are implementing the PSR interfaces. The last parameter is the configuration.

### Configuration

Possible configurations:

- `username` (string): Used for authentication.
- `password` (string): Used for authentication.
- `client` (string): Used for authentication.
- `tokenApiEndpoint` (string, valid URI): The Token API endpoint.
- `mainApiEndpoint` (string, valid URI): The Main API endpoint.
- `referenceDataApiEndpoint` (string, valid URI): The Reference Data API endpoint.

### Check connection

```php
$response = $client->checkConnection();
```
Will return true or false depending on the availability of the CDT service.

### Get reference data

```php
$response = $client->getReferenceData();
```
Will return an array of business reference data, with the list of departments, priorities, purposes, delivery modes, 
confidentialities, languages, statuses, services and send options. It also contains the contact data for the translation service.
The response is of the type `OpenEuropa\CdtClient\Model\Response\ReferenceData`.  

## Contributing

Please read [the full documentation](https://github.com/openeuropa/openeuropa) for details on our code of conduct,
and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. 