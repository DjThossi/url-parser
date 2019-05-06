<?php

namespace Unit\DjThossi\UrlParser;

use DjThossi\UrlParser\UrlParser;
use DjThossi\UrlParser\UrlParserException;
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

    /**
     * @dataProvider brokenUrlsProvider
     *
     * @throws UrlParserException
     */
    public function testThrowsException(string $url, string $exceptionMessage): void
    {
        $parser = new UrlParser();

        $this->expectException(UrlParserException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $parser->parseUrl($url);
    }

    public function brokenUrlsProvider(): array
    {
        return [
            'Not possible to parse URL' => [
                'http:///www.sebastianthoss.de',
                'Not possible to parse URL',
            ],
            'Scheme is currently not allowed to be empty' => [
                '//www.sebastianthoss.de',
                'Scheme is currently not allowed to be empty',
            ],
            'Host is not allowed to be empty' => [
                'http:/en/big-five-for-life/',
                'Host is not allowed to be empty',
            ],
        ];
    }
}
