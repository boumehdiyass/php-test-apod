PHP Test APOD Application
========================

The "PHP Test APOD Application" is created to add a new feature described in the [README File][1].

Requirements
------------

  * PHP 7.2.5 or higher;
  * SqlLite, MySQL, or PostgreSQL server;
  * Apache Web server
  * [composer][2] must be installed;
  * Git must be installed
  * [Symfony CLI][4] is optional
  * and the [usual Symfony application requirements][3].

Installation
------------
  * clone project : git clone https://github.com/boumehdiyass/php-test-apod.git
  * install all dependencies: symfony composer install
  * add and set these Google API Keys in your .env files OAUTH_GOOGLE_CLIENT_ID & OAUTH_GOOGLE_CLIENT_SECRET or use this symfony command [symfony console secrets:set][5] to keep sensitive information secret 
  * add and set NASA APOD API KEY in your .env files APOD_API_KEY (or use [symfony console secrets:set][5])
  * configure database in your .env files by editing DATABASE_URL

Usage
-----
There's no need to configure anything to run the application. If you have
[installed Symfony][4] binary, run this command:

```bash
$ cd php-test-apod/
$ symfony serve -d
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][6] like Nginx or
Apache to run the application.

Create the database : 

```bash
$ symfony composer create-database
```

Fetch picture of the day with CLI Command: 

```bash
$ symfony console app:apod:fetch
```

Fetch picture of specified day with CLI Command: 
```bash
$ symfony console app:apod:fetch --date 2022-01-07
```

Authentication :
you can login using your google account to access the picture page

Tests
-----

Execute this command to run tests:

```bash
$ cd php-test-apod/
$ symfony php bin/phpunit
```

[1]: https://github.com/boumehdiyass/php-test-apod/blob/master/README.md
[2]: https://getcomposer.org/
[3]: https://symfony.com/doc/current/setup.html#technical-requirements
[4]: https://symfony.com/download
[5]: https://symfony.com/doc/current/configuration/secrets.html
[6]: https://symfony.com/doc/current/setup/web_server_configuration.html
