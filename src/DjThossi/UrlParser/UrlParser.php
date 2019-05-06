<?php
declare(strict_types=1);

namespace DjThossi\UrlParser;

class UrlParser
{
    /**
     * @throws UrlParserException
     */
    public function parseUrl(string $url): ParsedUrl
    {
        $parsedUrl = parse_url($url);
        if (!is_array($parsedUrl)) {
            throw new UrlParserException('Not possible to parse URL');
        }

        $scheme = isset($parsedUrl['scheme']) ? (string)$parsedUrl['scheme'] : null;
        $host = isset($parsedUrl['host']) ? (string)$parsedUrl['host'] : null;
        $port = isset($parsedUrl['port']) ? (string)$parsedUrl['port'] : null;
        $path = isset($parsedUrl['path']) ? (string)$parsedUrl['path'] : null;
        $query = isset($parsedUrl['query']) ? (string)$parsedUrl['query'] : null;
        $fragment = isset($parsedUrl['fragment']) ? (string)$parsedUrl['fragment'] : null;

        $user = isset($parsedUrl['user']) ? (string)$parsedUrl['user'] : null;
        $password = isset($parsedUrl['pass']) ? (string)$parsedUrl['pass'] : null;

        try {
            $basicAuth = null;
            if (is_string($user)) {
                $basicAuth = new BasicAuth($user, $password);
            }

            return new ParsedUrl($scheme, $basicAuth, $host, $port, $path, $query, $fragment);
        } catch (EnsureSchemeException|EnsureHostException|BasicAuthEnsureException $exception) {
            throw new UrlParserException($exception->getMessage(), 0, $exception);
        }
    }
}