AfterPay API
=======================

PHP library to interface with the [Afterpay API](https://docs.afterpay.com.au/) 

[![CircleCI](https://circleci.com/gh/culturekings/afterpay.svg?style=svg)](https://circleci.com/gh/culturekings/afterpay)

[![Coverage Status](https://coveralls.io/repos/github/culturekings/afterpay/badge.svg)](https://coveralls.io/github/culturekings/afterpay)
[![Scrutinizer](https://scrutinizer-ci.com/g/culturekings/afterpay/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/culturekings/afterpay/badges/quality-score.png?b=master)


## Installation

The recommended way to install is via [Composer](http://getcomposer.org).


```bash
composer require culturekings/afterpay
```

Don't forget to include Composer's autoloader if you haven't already:

```php
require 'vendor/autoload.php';
```

## Usage

All the documented calls 

### Fetch Configuration

```php
$authorization = new \CultureKings\Afterpay\Authorization(
    \CultureKings\Afterpay\Model\Authorization::SANDBOX_URI,
    '1234',
    'soSecret'
);

$configuration = \CultureKings\Afterpay\Factory\Api::configuration($authorization)->get()
```

### Fetch Payments List

```php
$authorization = new \CultureKings\Afterpay\Authorization(
    \CultureKings\Afterpay\Model\Authorization::SANDBOX_URI,
    '1234',
    'soSecret'
);

$payments = \CultureKings\Afterpay\Factory\Api::payments($authorization)->list()
```

## Special Thanks

[JMS Serializer](https://github.com/schmittjoh/serializer)

[Guzzle](https://github.com/guzzle/guzzle)

