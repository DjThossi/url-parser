<?php

namespace Unit\DjThossi\UrlParser;

use DjThossi\UrlParser\BasicAuth;
use DjThossi\UrlParser\ParsedUrl;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DjThossi\UrlParser\ParsedUrl
 */
class ParsedUrlGetterTest extends TestCase
{
    /**
     * @var ParsedUrl
     */
    private $parsedUrl;

    public function testCanCreateInstance(): void
    {
        $this->assertInstanceOf(ParsedUrl::class, $this->parsedUrl);
    }

    public function testGetDomainWithoutBasicAuth(): void
    {
        $this->assertEquals('http://www.sebastianthoss.de:80', $this->parsedUrl->getDomain());
    }

    public function testGetDomainWithBasicAuth(): void
    {
        $this->assertEquals('http://www.sebastianthoss.de:80', $this->parsedUrl->getDomain(true));
    }

    public function testHasBasicAuthFalse(): void
    {
        $this->assertFalse($this->parsedUrl->hasBasicAuth());
    }

    public function testGetBasicAuthWithoutBasicAuth(): void
    {
        $this->assertNull($this->parsedUrl->getBasicAuth());
    }

    public function testGetPath(): void
    {
        $this->assertEquals('/en/big-five-for-live?hello=world#anker', $this->parsedUrl->getPath());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->parsedUrl = new ParsedUrl(
            'http',
            null,
            'www.sebastianthoss.de',
            '80',
            '/en/big-five-for-live',
            'hello=world',
            'anker'
        );
    }
}
