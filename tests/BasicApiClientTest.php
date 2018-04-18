<?php

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use Yuca\BasicApiClient;

/**
 * @group unit
 */
final class BasicApiClientTest extends TestCase
{
    public function testBaseUrl()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('baseUrl is required.');

        new BasicApiClient([
            'wrongBaseUrl' => 'https://example.com',
            'username' => 'fake',
            'password' => 'fake',
        ]);
    }
}
