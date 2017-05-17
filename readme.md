# [Open Medical Payment Data Application](https://openpaymentsdata-origin.cms.gov/)
## Getting Started
First, clone the repo:
```bash
$ git clone git@github.com:hasib32/payment.git
```
#### Dev server with Laravel Homestaed
I have used Laravel Homestead for local development. Follow the Follow the [Installation Guide](https://laravel.com/docs/5.4/homestead#installation-and-setup) to install Homestead.

### Install MonogoDB
Homestead does not come with MongoDB. I have used this script to install [MongoDB](https://github.com/zakhttp/Mongostead7)

#### Install dependencies
```
$ cd payment
$ composer install
$ npm install
```

#### Configure the Environment
Create `.env` file:
```
$ cat .env.example > .env
```
### Setup Virrual Host
```
$ sudo vi /etc/hosts
```
Paste this line
```
192.168.10.10 payment.dev
```

## Running phpunit tests
Run this command from the projcet root directory.
```bash
$ vendor/bin/phpunit
```
