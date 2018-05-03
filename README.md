# Introduction
This is library for access to WordPress API websites easy.

# Installation
You can simply install with composer:

`composer require nunocodex/wpapi`

# Readme is working progress

```php
// GuzzleHttp options
$wpapiClientOptions = [
    'base_uri' => 'http://example.com/',
    'verify' => false,
    'auth' => [ 'user', 'pass' ]
];

// It's a GuzzleHttp extended class so you can bind
// the client with WpApiClientInterface for no change
// anything in this code.
$wpapiClient = new WpApiClient($wpapiClientOptions);

// WpApi object
$wpapi = new WpApi($wpapiClient);

$posts = $wpapi->posts()->embed()->filter([ 'order' => 'asc' ])->pagination(10)->get();
```
