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

$client->put('article/1', [
    'title' => 'New Title',
    'body' => 'New Body'
]);

$client->patch('article/1', [
    'title' => 'New Title'
]);

$client->delete('article/1');
```

License
-------
MIT