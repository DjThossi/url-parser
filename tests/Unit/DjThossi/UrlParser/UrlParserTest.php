<?php

namespace Unit\DjThossi\UrlParser;

use DjThossi\UrlParser\UrlParser;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DjThossi\UrlParser\UrlParser
 */
class UrlParserTest extends TestCase
{
    public function testCanInstantiate(): void
    {
        $parser = new UrlParser();
        $this->assertInstanceOf(UrlParser::class, $parser);
    }
}
