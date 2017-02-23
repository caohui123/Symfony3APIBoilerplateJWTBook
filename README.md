# Symfony3APIBoilerplateJWTBook

[![Build Status](https://travis-ci.org/Tony133/Symfony3APIBoilerplateJWTBook.svg?branch=master)](https://travis-ci.org/Tony133/Symfony3APIBoilerplateJWTBook)

Simple Example Api Rest Book with Symfony 3 and JWT(Json Web Token)

## Install with Composer

```
    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar install
```
## Generate the SSH keys

```
	$ mkdir var/jwt 
	$ openssl genrsa -out var/jwt/private.pem -aes256 4096 
	$ openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
```

## Generate Token Authentication with Curl

```
	$ curl -H 'content-type: application/json' -v -X  POST http://127.0.0.1:8000/api/token -H 'Authorization:Basic username:password'
```

## Getting with Curl 

```
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/books 
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/books/:id
    $ curl -H 'content-type: application/json' -v -X POST -d '{"name":"Foo bar","price":"19.99"}' http://127.0.0.1:8000/api/books 
    $ curl -H 'content-type: application/json' -v -X PUT -d '{"name":"Foo bar","price":"19.99"}' http://127.0.0.1:8000/api/books/:id
    $ curl -H 'content-type: application/json' -v -X DELETE http://127.0.0.1:8000/api/books/:id
```

## Example JSON Web Token Authentication with Curl on resource 

```
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/books  -H 'Authorization: Bearer :token' 
```
