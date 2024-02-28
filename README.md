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
        'validateApiEndpoint' => 'https://example.com/v2/requests/validate',
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
- `validateApiEndpoint` (string, valid URI): The Validate API endpoint.

### Check connection

```php
$response = $client->checkConnection();
```

Will return true or false depending on the availability of the CDT service.

### Translation requests

To create the translation request, you need to build the `OpenEuropa\CdtClient\Model\Request\Translation` object:

```php
use OpenEuropa\CdtClient\Model\Request\Callback;
use OpenEuropa\CdtClient\Model\Request\CallbackCollection;
use OpenEuropa\CdtClient\Model\Request\File;
use OpenEuropa\CdtClient\Model\Request\ReferenceFile;
use OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection;
use OpenEuropa\CdtClient\Model\Request\ReferenceUrl
use OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection;
use OpenEuropa\CdtClient\Model\Request\SourceDocument;
use OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Model\Request\TranslationJob;
use OpenEuropa\CdtClient\Model\Request\TranslationJobCollection;

$translationRequest = (new Translation())
    ->setDepartmentCode('250771')
    ->setContactUserNames(['DGTRADETUCE'])
    ->setDeliveryContactUsernames(['DGTRADETUCE'])
    ->setPhoneNumber('123456789')
    ->setTitle('Translation for Translation Centre For the Bodies of the EU')
    ->setClientReference('3')
    ->setPurposeCode('PC')
    ->setPriorityCode('SL')
    ->setComments('Do not translate the URLs')
    ->setReferenceSetUrls(new ReferenceUrlCollection([
        (new ReferenceUrl())
            ->setUrl('http://cdt.europa.eu')
            ->setShortName('Translation Centre For the Bodies of the EU"')
            ->setReferenceLanguages(['EN'])
    ]))
    ->setReferenceSetFiles(new ReferenceFileCollection([
        (new ReferenceFile())
            ->setFile((new File())
                ->setFileName('reference_file_TEST_request.xml')
                ->setBase64Data('PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+')
            )
            ->setReferenceLanguages(['EN'])
    ]))
    ->setSourceDocuments(new SourceDocumentCollection([
        (new SourceDocument())
            ->setFile((new File())
                ->setFileName('translation_job_TEST_request.xml')
                ->setBase64Data('PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+')
            )
            ->setSourceLanguages(['EN'])
            ->setOutputDocumentFormatCode('XM')
            ->setTranslationJobs(new TranslationJobCollection([
                (new TranslationJob())
                    ->setTargetLanguage('FR')
                    ->setSourceLanguage('EN')
                    ->setVolume(0.5)
            ]))
            ->setConfidentialityCode('NO')
        ])
    )
    ->setSendOptions('Send')
    ->setService('Translation')
    ->setIsQuotationOnly(false)
    ->setCallbacks(new CallbackCollection([
        (new Callback())
            ->setCallbackBaseUrl('https://example.com/callback')
            ->setCallbackType('REQUEST_STATUS')
            ->setClientApiKey('1234567890')
    ]));
```

To validate the above request, run the following code:

```php
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;

try {
    $response = $client->validateTranslationRequest($translationRequest);
} catch (ValidationErrorsException $e) {
    $errors = $e->getValidationErrors();
}
```

The endpoint will return either `true`, or a list of validation errors.

## Contributing

Please read [the full documentation](https://github.com/openeuropa/openeuropa) for details on our code of conduct,
and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. 