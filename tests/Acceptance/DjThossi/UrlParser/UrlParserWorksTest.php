<?php

namespace Acceptance\DjThossi\UrlParser;

use DjThossi\UrlParser\UrlParser;
use DjThossi\UrlParser\UrlParserException;
use PHPUnit\Framework\TestCase;

class UrlParserWorksTest extends TestCase
{
    /**
     * @dataProvider workingUrlsProvider
     *
     * @throws UrlParserException
     */
    public function testCanParseUrl(string $url): void
    {
        $parser = new UrlParser();
        $parsedUrl = $parser->parseUrl($url);
        $this->assertEquals($url, $parsedUrl->getDomain(true) . $parsedUrl->getPath());
    }

    public function workingUrlsProvider(): array
    {
        return [
            'https://www.smest.it' => ['https://www.smest.it'],
            'http://www.smest.it' => ['http://www.smest.it'],
            'http://user:password@www.smest.it' => ['http://user:password@www.smest.it'],
            'http://user:password@www.smest.it:80' => ['http://user:password@www.smest.it:80'],
            'http://user:password@www.smest.it:80/test.php' => ['http://user:password@www.smest.it:80/test.php'],
            'http://user:password@www.smest.it:80/test.php?hello=world' => ['http://user:password@www.smest.it:80/test.php?hello=world'],
            'http://user:password@www.smest.it:80/test.php?hello=world#anker' => ['http://user:password@www.smest.it:80/test.php?hello=world#anker'],
        ];
    }
}
