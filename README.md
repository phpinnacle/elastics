# PHPinnacle Elastics

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require phpinnacle/elastics
```

## Basic Usage

```php
<?php

use PHPinnacle\Elastics\Search;
use PHPinnacle\Elastics\Query;

require __DIR__ . '/vendor/autoload.php';

$query = new Query\Boolean();
$query
    ->must(new Query\Match('name', 'Alex'))
    ->mustNot(
        new Query\Term('gender', 'male'),
        new Query\Terms('eye_color', ['blue', 'green'])
    )
    ->filter(new Query\Range('age', 21))
;

$search = Search::match($query);
$search
    ->order('name', 'asc')
    ->limit(50)
;

$client = curl_init('127.0.0.1:9200/users/_search?pretty');

curl_setopt_array($client, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS     => (string) $search,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
]);

$result = curl_exec($client);

echo $result;
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email dev@phpinnacle.com instead of using the issue tracker.

## Credits

- [PHPinnacle][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpinnacle/elastics.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/phpinnacle/elastics.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/phpinnacle/elastics.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpinnacle/elastics.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpinnacle/elastics
[link-scrutinizer]: https://scrutinizer-ci.com/g/phpinnacle/elastics/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/phpinnacle/elastics
[link-downloads]: https://packagist.org/packages/phpinnacle/elastics
[link-author]: https://github.com/phpinnacle
[link-contributors]: ../../contributors
