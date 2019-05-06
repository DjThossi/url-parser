<?php

declare(strict_types=1);

namespace Unit\DjThossi\UrlParser;

use DjThossi\UrlParser\BasicAuth;
use DjThossi\UrlParser\BasicAuthEnsureException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DjThossi\UrlParser\BasicAuth
 * @covers \DjThossi\UrlParser\BasicAuthEnsureException
 */
class BasicAuthTest extends TestCase
{
    /**
     * @dataProvider validBasicAuthDataProvider
     */
    public function testCanCreateInstance(string $user, ?string $password): void
    {
        $basicAuth = new BasicAuth($user, $password);
        $this->assertInstanceOf(BasicAuth::class, $basicAuth);
    }

    public function validBasicAuthDataProvider(): array
    {
        return [
            'user: user password: null' => ['user', null],
            'user: 0 password: null' => ['0', null],
            'user: user password: password' => ['user', 'password'],
            'user: user password: empty string' => ['user', ''],
        ];
    }

    public function testWillThrowExceptionOnEmptyUsername(): void
    {
        $this->expectException(BasicAuthEnsureException::class);
        $this->expectExceptionMessage('Username should not be empty');

        new BasicAuth('');
    }

    public function testGenerateUrlStringWithUsernameOnly(): void
    {
        $basicAuth = new BasicAuth('user');
        $this->assertEquals('user:@', $basicAuth->generateUrlString());
    }

    public function testGenerateUrlStringWithUsernameAndPassword(): void
    {
        $basicAuth = new BasicAuth('user', 'password');
        $this->assertEquals('user:password@', $basicAuth->generateUrlString());
    }

    public function testGetUsername(): void
    {
        $username = 'user';
        $basicAuth = new BasicAuth($username);
        $this->assertEquals($username, $basicAuth->getUsername());
    }

    public function testGetPassword(): void
    {
        $password = 'password';
        $basicAuth = new BasicAuth('user', $password);
        $this->assertEquals($password, $basicAuth->getPassword());
    }
}
