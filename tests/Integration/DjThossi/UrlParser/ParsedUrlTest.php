<?php

namespace Integration\DjThossi\UrlParser;

use DjThossi\UrlParser\BasicAuth;
use DjThossi\UrlParser\ParsedUrl;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ParsedUrlTest extends TestCase
{
    /**
     * @var BasicAuth
     */
    private $basicAuth;

    /**
     * @var ParsedUrl
     */
    private $parsedUrl;

    public function testCanCreateInstance(): void
    {
        $this->assertInstanceOf(ParsedUrl::class, $this->parsedUrl);
    }

    /**
     * @covers \DjThossi\UrlParser\ParsedUrl
     */
    public function testGetDomainWithBasicAuth(): void
    {
        $this->assertEquals('http://user:password@www.sebastianthoss.de:80', $this->parsedUrl->getDomain(true));
    }

    public function testHasBasicAuthTrue(): void
    {
        $this->assertTrue($this->parsedUrl->hasBasicAuth());
    }

    public function testGetBasicAuthWithBasicAuth(): void
    {
        $this->assertSame($this->basicAuth, $this->parsedUrl->getBasicAuth());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->basicAuth = new BasicAuth('user', 'password');

        $this->parsedUrl = new ParsedUrl(
            'http',
            $this->basicAuth,
            'www.sebastianthoss.de',
            '80',
            '/en/big-five-for-live',
            'hello=world',
            'anker'
        );
    }
}
