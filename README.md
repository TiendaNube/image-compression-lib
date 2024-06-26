# image-compression-lib
This library is used by https://github.com/TiendaNube/tiendanube for image processing.

# Useful commands

## Run lint
```
docker compose -f docker-compose.cli.yml run --rm php-cs-fixer fix --verbose
```

## Run unit tests
```
docker compose run --no-deps --rm php-cli composer test
```

## Run rector
```
docker compose run --no-deps --rm php-rector php ../rector/vendor/bin/rector process
```