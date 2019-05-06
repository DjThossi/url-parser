<?php

namespace Unit\DjThossi\UrlParser;

use DjThossi\UrlParser\BasicAuth;
use DjThossi\UrlParser\EnsureHostException;
use DjThossi\UrlParser\EnsureSchemeException;
use DjThossi\UrlParser\ParsedUrl;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DjThossi\UrlParser\ParsedUrl
 */
class BrokenParsedUrlTest extends TestCase
{
    public function testThrowsExceptionOnInvalidScheme(): void
    {
        $this->expectException(EnsureSchemeException::class);

        new ParsedUrl(
            'broken',
            null,
            'www.sebastianthoss.de',
            null,
            null,
            null,
            null
        );
    }

    public function testThrowsExceptionOnInvalidHost(): void
    {
        $this->expectException(EnsureHostException::class);

        new ParsedUrl(
            'http',
            null,
            '',
            null,
            null,
            null,
            null
        );
    }
}
