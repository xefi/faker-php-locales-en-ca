# Faker PHP — en_CA locale

Canadian English (`en_CA`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-en-ca
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('en_CA');
```

Generators without a `en_CA` variant fall back to the default locale.

## Locale-specific generators

```php
$faker->province();       // 'Ontario'
$faker->provinceCode();   // 'ON'
$faker->postcode();       // 'K1A 0B1'
$faker->sin();            // Social Insurance Number, valid Luhn check digit
$faker->businessNumber(); // 9-digit Business Number, valid Luhn check digit
```

Canada does not use IBAN: `iban()` returns an IBAN-shaped `CA` string built from a transit, institution and account number.

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerEnCaServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
