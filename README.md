[Afterpay API](https://culturekings.github.io/afterpay/)
=======================

PHP library to interface with the [Afterpay API](http://docs.afterpay.com.au/)

[![Coverage Status](https://coveralls.io/repos/github/culturekings/afterpay/badge.svg)](https://coveralls.io/github/culturekings/afterpay)
[![CircleCI](https://img.shields.io/circleci/project/culturekings/afterpay.svg?style=svg)](https://circleci.com/gh/culturekings/afterpay)
[![Scrutinizer](https://scrutinizer-ci.com/g/culturekings/afterpay/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/culturekings/afterpay/)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/b9b910ea-dc47-4459-a7b1-ff9da76edebd.svg)](https://insight.sensiolabs.com/projects/b9b910ea-dc47-4459-a7b1-ff9da76edebd)

## Installation

The recommended way to install is via [Composer](http://getcomposer.org).


```bash
composer require culturekings/afterpay
```

Don't forget to include Composer's auto-loader if you haven't already:

```php
require 'vendor/autoload.php';
```

## Merchant API
[API Documentation](docs/merchant/api.md)

## InStore API
[API Documentation](docs/instore/api.md)

## Known Afterpay Issues

1. Passing in a Money value with more than 2 decimal places will result in an error from Afterpay saying 'The request contains improperly formated JSON'. [Issues #33](https://github.com/culturekings/afterpay/issues/33) outlines this problem. 
This library will not provide rounding or manipulation of values as it's is the responsability of the project to provide accurate values. Thanks @rudolfl for the report.


## Special Thanks

[JMS Serializer](https://github.com/schmittjoh/serializer)

[Guzzle](https://github.com/guzzle/guzzle)

