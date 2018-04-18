Basic API Client
----------------

A simple PHP client to make an API request based on HTTP Basic Authentication.

Instalation
-----------

```sh
composer require yuca/basic-api-client
```

Usage
-----

```php
$client = new Yuca\BasicApiClient([
    'baseUrl' => 'https://example.com/api',
    'username' => 'username',
    'password' => 'password',
    'return' => 'array', // object or array
]);

$client->get('articles', ['limit' => 10]);

$client->post('article/create', ['title' => 'Awesome!']);
```

License
-------
MIT