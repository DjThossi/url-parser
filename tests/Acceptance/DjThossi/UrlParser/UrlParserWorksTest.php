<?php

declare(strict_types=1);

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
            'https://www.sebastianthoss.de' => ['https://www.sebastianthoss.de'],
            'http://www.sebastianthoss.de' => ['http://www.sebastianthoss.de'],
            'http://user:password@www.sebastianthoss.de' => ['http://user:password@www.sebastianthoss.de'],
            'http://user:password@www.sebastianthoss.de:80' => ['http://user:password@www.sebastianthoss.de:80'],
            'http://user:password@www.sebastianthoss.de:80/en/big-five-for-life/' => ['http://user:password@www.sebastianthoss.de:80/en/big-five-for-life/'],
            'http://user:password@www.sebastianthoss.de:80/en/big-five-for-life/?hello=world' => ['http://user:password@www.sebastianthoss.de:80/en/big-five-for-life/?hello=world'],
            'http://user:password@www.sebastianthoss.de:80/en/big-five-for-life/?hello=world#anker' => ['http://user:password@www.sebastianthoss.de:80/en/big-five-for-life/?hello=world#anker'],
        ];
    }
}
