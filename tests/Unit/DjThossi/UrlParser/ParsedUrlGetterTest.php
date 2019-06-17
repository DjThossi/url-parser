<?php

declare(strict_types=1);

namespace Unit\DjThossi\UrlParser;

use DjThossi\UrlParser\ParsedUrl;
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
            'fragment'
        );
    }

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

    public function testGetScheme(): void
    {
        $this->assertEquals('http', $this->parsedUrl->getScheme());
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
        $this->assertEquals('/en/big-five-for-live?hello=world#fragment', $this->parsedUrl->getPath());
    }

    public function testGetPathWithoutQuery(): void
    {
        $this->assertEquals('/en/big-five-for-live#fragment', $this->parsedUrl->getPath(false));
    }

    public function testGetPathWithoutFragment(): void
    {
        $this->assertEquals('/en/big-five-for-live?hello=world', $this->parsedUrl->getPath(true, false));
    }

    public function testGetPathWithoutBoth(): void
    {
        $this->assertEquals('/en/big-five-for-live', $this->parsedUrl->getPath(false, false));
    }
}
