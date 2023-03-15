# Laravel Sail Https

[![Latest Version on Packagist](https://img.shields.io/packagist/v/assurdeal/sail-https.svg?style=flat-square)](https://packagist.org/packages/assurdeal/sail-https)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/assurdeal/laravel-sail-https/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/assurdeal/laravel-sail-https/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/assurdeal/laravel-sail-https/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/assurdeal/laravel-sail-https/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/assurdeal/sail-https.svg?style=flat-square)](https://packagist.org/packages/assurdeal/sail-https)

This package allows you to use HTTPS in your Laravel Sail development environment.

## Installation

You can install the package via composer:

```bash
composer require assurdeal/sail-https --dev
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="sail-https-config"
```

## Usage

Add your authorized domains to your `.env` file:

```dotenv   
SAIL_HTTPS_AUTHORIZED_DOMAINS=example.text,example2.test
```

Add the following to your `docker-compose.yml` file:

```yaml 
volumes:
  sail-caddy:
    driver: local
```

```yaml
### Caddy Server reverse proxy ############################
caddy:
  image: caddy:latest
  restart: unless-stopped
  ports:
    - '${APP_SSL_PORT:-443}:443'
  volumes:
    - './vendor/assurdeal/sail-https/.docker/caddy/Caddyfile:/etc/caddy/Caddyfile'
    - sail-caddy:/data
    - sail-caddy:/config
  networks:
    - sail
```

## Set up SSL certificate

First get the Caddy container ID

```bash
docker ps | grep caddy
```

Then copy the Certificate from the Container

```bash
docker cp {container_id}:/config/caddy/pki/authorities/local/root.crt ~/Desktop
```

### MacOS
Finally, open up "Keychain Access.app" and drag and drop the certificate into the "login" keychain. Open the 
certificate (it should be called something like "Caddy Local Authority") and configure it to "Always Trust".

### Windows
1) To add, use the command:
certutil -addstore -f "ROOT" root.crt

2) To remove, use the command:
certutil -delstore "ROOT" serial-number-hex

### Linux (Ubuntu, Debian)
1) To add:
    - Copy your CA to dir `/usr/local/share/ca-certificates/`
    - Use command: `sudo cp root.crt /usr/local/share/ca-certificates/root.crt`
    - Update the CA store: `sudo update-ca-certificates`
2) To remove:
    - Remove your CA.
    - Update the CA store: `sudo update-ca-certificates --fresh`

<b>Note:</b> Restart Kerio Connect to reload the certificates in the 32-bit versions or Debian 7.

### Linux (CentOs 6)

1) Install the ca-certificates package: `yum install ca-certificates`
2) Enable the dynamic CA configuration feature: `update-ca-trust force-enable`
3) Add it as a new file to /etc/pki/ca-trust/source/anchors/: `cp root.crt /etc/pki/ca-trust/source/anchors/`
4) Use command: `update-ca-trust extract`

### Linux (CentOs 5)

Append your trusted certificate to file /etc/pki/tls/certs/ca-bundle.crt

`cat root.crt >>/etc/pki/tls/certs/ca-bundle.crt`

<b>Note:</b> Restart Kerio Connect to reload the certificates in the 32-bit version.

## Testing

```bash
composer test
```

## Credits
Big Thanks to all developers who worked hard to create something amazing!

## Creator
[![Percy Mamedy](https://img.shields.io/badge/Author-Percy%20Mamedy-orange.svg)](https://twitter.com/PercyMamedy)

Twitter: [@PercyMamedy](https://twitter.com/PercyMamedy)
<br/>
GitHub: [percymamedy](https://github.com/percymamedy)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
