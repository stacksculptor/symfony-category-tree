## Dependencies

Before getting started, you will need:

- PHP (8+)
- Symfony

## Usage

`composer install`

`bin/console tailwind:build -w`

`bin/console doctrine:database:create`

`bin/console doctrine:migrations:migrate`

`php bin/console doctrine:fixtures:load`

`symfony server:start`


## Test

`php bin/console make:test`
`vendor/bin/bdi detect drivers`
`php bin/phpunit`
