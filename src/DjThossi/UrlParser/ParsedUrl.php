<?php

declare(strict_types=1);

namespace DjThossi\UrlParser;

class ParsedUrl
{
    /**
     * @var string
     */
    private $scheme;

    /**
     * @var BasicAuth|null
     */
    private $basicAuth;

    /**
     * @var string
     */
    private $host;

    /**
     * @var null|string
     */
    private $port;

    /**
     * @var null|string
     */
    private $path;

    /**
     * @var null|string
     */
    private $query;

    /**
     * @var null|string
     */
    private $fragment;

    /**
     * @throws EnsureHostException
     * @throws EnsureSchemeException
     */
    public function __construct(
        string $scheme,
        ?BasicAuth $basicAuth,
        string $host,
        ?string $port,
        ?string $path,
        ?string $query,
        ?string $fragment
    ) {
        $this->ensureScheme($scheme);
        $this->ensureHost($host);

        $this->scheme = $scheme;
        $this->basicAuth = $basicAuth;
        $this->host = $host;
        $this->port = $port;
        $this->path = $path;
        $this->query = $query;
        $this->fragment = $fragment;
    }

    public function getDomain(bool $includeBasicAuth = false): string
    {
        $basicAuth = null;
        if ($includeBasicAuth && $this->hasBasicAuth()) {
            $basicAuth = $this->basicAuth->generateUrlString();
        }

        $port = null;
        if ($this->port !== null) {
            $port = ':' . $this->port;
        }

        return sprintf(
            '%s://%s%s%s',
            $this->scheme,
            $basicAuth,
            $this->host,
            $port
        );
    }

    public function hasBasicAuth(): bool
    {
        return $this->basicAuth !== null;
    }

    public function getBasicAuth(): ?BasicAuth
    {
        return $this->basicAuth;
    }

    public function getPath(bool $addQuery = true, bool $addFragment = true): string
    {
        $query = null;
        if ($addQuery === true && $this->query !== null) {
            $query = '?' . $this->query;
        }

        $fragment = null;
        if ($addFragment === true && $this->fragment !== null) {
            $fragment = '#' . $this->fragment;
        }

        return $this->path . $query . $fragment;
    }

    /**
     * @throws EnsureSchemeException
     */
    private function ensureScheme(string $scheme): void
    {
        if (!in_array($scheme, ['http', 'https'], true)) {
            throw new EnsureSchemeException('only "http", "https" is currently supported');
        }
    }

    /**
     * @throws EnsureHostException
     */
    private function ensureHost(string $host): void
    {
        if (empty($host)) {
            throw new EnsureHostException('$host is not allowed to be empty');
        }
    }
}
