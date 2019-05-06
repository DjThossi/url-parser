<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Integration\DjThossi\UrlParser;

use DjThossi\UrlParser\UrlParser;
use DjThossi\UrlParser\UrlParserException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DjThossi\UrlParser\UrlParser
 */
class UrlParserTest extends TestCase
{
    public function testCanParseUrl(): void
    {
        $url = 'http://user:password@www.sebastianthoss.de:80/en/big-five-for-life/?hello=world#anker';

        $parser = new UrlParser();
        $parsedUrl = $parser->parseUrl($url);
        $this->assertEquals($url, $parsedUrl->getDomain(true) . $parsedUrl->getPath());
    }

    public function testThrowsExceptionOnBrokenBasicAuth(): void
    {
        $url = 'http://:password@www.sebastianthoss.de';

        $parser = new UrlParser();

        $this->expectException(UrlParserException::class);
        $this->expectExceptionMessage('Username should not be empty');

        $parser->parseUrl($url);
    }
}
