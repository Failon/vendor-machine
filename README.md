Vendor Machine
==============


# Installation

First, clone this repository:

```bash
$ git clone https://github.com/Failon/vendor-machine
```

Then, run:

```bash
$ docker-compose up
```
Remember to add the following line to your /etc/hosts or your windows host file.
```bash
127.0.0.1 symfony.localhost
```

Now set yourself into the php-fpm container

```bash
$ docker exec -ti php-fpm sh
```
you should see something like this:

```bash
/var/www/symfony #
```

Then Execute the following commands one by one.
```bash
$ composer install
$ php bin/console doctrine:schema:update --force
$ php bin/console doctrine:migrations:migrate
```
You are done, you can visit your Symfony application on the following URL: `http://symfony.localhost`

Note: When you review the code, be sure to set php version language to 8.0+ in your IDE or editor
