# UrlParser
This URL parser works currenlty only for http and https. If you required // or other protocols, feel free to add them. 
[![Build Status](https://travis-ci.org/DjThossi/url-parser.svg?branch=master)](https://travis-ci.org/DjThossi/url-parser)
[![Maintainability](https://api.codeclimate.com/v1/badges/1e7ffed73287ebac3514/maintainability)](https://codeclimate.com/github/DjThossi/url-parser/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/1e7ffed73287ebac3514/test_coverage)](https://codeclimate.com/github/DjThossi/url-parser/test_coverage)

## How to install
You have several options to install this package

### Composer
`composer require djthossi/url-parser`

### Git
`git clone https://github.com/DjThossi/url-parser.git`

### Download
`https://github.com/DjThossi/url-parser/archive/master.zip`

## Example
```php
use DjThossi\UrlParser\ParsedUrl;
use DjThossi\UrlParser\UrlParser;

class SomeClass
{
    public function parseUrl(string $url): ParsedUrl
    {
        $urlParser = new UrlParser();
        return $urlParser->parseUrl($url);
    }
}
```
