# Social Importer

The Social Importer is a service package for [offbeatWP](https://github.com/offbeatwp).

## Installation
Install the package using [Composer](https://getcomposer.org/) (**First you need to go to the OffbeatWP theme folder**)

```
composer require offbeatwp/social-importer
```

Then you need to add the social importer as service. You can do this by adding the service in the `config/service.php` file.
```
OffbeatWP\SocialImporter\Service::class,
```
Now make a `social_importer.php` file in `config` folder. You need to register the API key using this file.
```
return [
    [
        'id'           => ‘account_insta',
        'type'         => 'instagram',
        'api_key'      => ‘my api key',
        'api_secret'   => ‘my secret',
    ],
```


The Facebook function does not work yet
