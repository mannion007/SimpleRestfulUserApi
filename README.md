Simple User API
===============
[![Build Status](https://travis-ci.org/mannion007/SimpleRestfulUserApi.svg?branch=master)](https://travis-ci.org/mannion007/SimpleRestfulUserApi)

A Simple no-framework RESTful User API created as a learning exercise.

The API uses [PropelORM](http://propelorm.org/) simply because I had never used it before and wanted to try it.

Instructions
============

1. Install dependencies using [Composer](https://getcomposer.org/)
2. Run vendor/bin/propel init - follow the instructions to configure

Running the tests
=================

1. Ensure you have installed dependencies with [Composer](https://getcomposer.org/)
2. {projectRoot}/vendor/bin/phpunit

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

Developed using [Cloud9Ide](https://ide.c9.io) and [Postman](https://www.getpostman.com) built using [Travis](https://docs.travis-ci.com/).