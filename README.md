Simple User API
===============

A Simple no-framework RESTful User API created as a learning exercise.

The API uses [PropelORM]http://propelorm.org/ simply because I had never used it before and wanted to try it.

Instructions
============

1. Install dependencies using [Composer]https://getcomposer.org/
2. Configure database credentials in propel.yml
3. Navigate to the project root directory
4. vendor/bin/propel init
5. run vendor/bin/propel sql:build
6. run vendor/bin/propel model:build

Running the tests
=================

1. Ensure you have ran composer install
2. {projectRoot}/vendor/bin/phpunit {projectRoot}/tests

Resources
=========

Create (PUT) user/create
------------------------
Required parameters: forename, surname, email

Update (POST) user/update
-------------------------
Required parameters: id, forename, surname, email

View (GET) user/view/{id}
-------------------------
Required parameters: id

Delete (DELETE) user/delete/{id}
---------------------------
Required parameters: id

Other Information
=================
If you can learn anything from this code, or modify and/or extend it to do anything more interesting or useful please feel free to do so.

Developed using [Cloud9Ide]https://ide.c9.io.