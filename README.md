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
        'tokenApiEndpoint' => 'https://example.com/token',
        'referenceDataApiEndpoint' => 'https://example.com/v2/requests/businessReferenceData',' => 'https://example.com/v2/requests/businessReferenceData',
        'validateApiEndpoint' => 'https://example.com/v2/requests/validate',
        'requestsApiEndpoint' => 'https://example.com/v2/requests',
        'identifierApiEndpoint' => 'https://example.com/v2/requests/requestIdentifierByCorrelationId/:correlationId',
        'statusApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber',
        'fileApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber/targets-base64',
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
- `validateApiEndpoint` (string, valid URI): The Validate API endpoint.
- `requestsApiEndpoint` (string, valid URI): The Requests API endpoint.
- `identifierApiEndpoint` (string, valid URI): The Identifier API endpoint.
- `statusApiEndpoint` (string, valid URI): The Status API endpoint.
- `fileApiEndpoint` (string, valid URI): The File API endpoint.

### Check connection

```php
$response = $client->checkConnection();
```

Will return true or false depending on the availability of the CDT service.


### Get reference data

```php
$response = $client->getReferenceData();
```
Will return an array of business reference data, serialized into  `OpenEuropa\CdtClient\Model\Response\ReferenceData`.

### Translation requests

To validate and send a translation request, run the following code:
```php
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;

$translationRequest = new Translation()
try {
    if ($client->validateTranslationRequest($translationRequest)) {
        $correlationId = $client->sendTranslationRequest($translationRequest);
    }
} catch (ValidationErrorsException $e) {
    $errors = $e->getValidationErrors();
    // Handle the errors.
}
```

On success, the `sendTranslationRequest()` method will return the temporary Correlation ID.

### Get permanent request identifier

```php
$permanentId = $client->getPermanentIdentifier($correlationId);
```

Will return a permanent string identifier for the translation request, based on correlation ID. Throws the `ValidationErrorsException` if the correlation ID is not found.

### Get the status of a translation request

```php
$translationStatus = $client->getRequestStatus($permanentId);
```
Will return information on the status of translation request, based on permanent ID. Throws the `ValidationErrorsException` if the permanent ID is invalid.

### Get the translated files

```php
$translatedFiles = $client->getTranslatedFiles($permanentId);
```
Will return the list of translated files (including contents), if available, based on permanent ID. Throws the `ValidationErrorsException` if the permanent ID is invalid.


## Contributing

Please read [the full documentation](https://github.com/openeuropa/openeuropa) for details on our code of conduct,
and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. 