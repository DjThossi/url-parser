<?php

declare(strict_types=1);

namespace DjThossi\UrlParser;

class BasicAuth
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @throws BasicAuthEnsureException
     */
    public function __construct(string $username, string $password = null)
    {
        $this->ensureUsername($username);

        $this->username = $username;
        $this->password = $password;
    }

    public function generateUrlString(): string
    {
        return sprintf(
            '%s:%s@',
            $this->username,
            $this->password
        );
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @throws BasicAuthEnsureException
     */
    private function ensureUsername(string $username): void
    {
        if ($username === '0') {
            return;
        }

        if (empty($username)) {
            throw new BasicAuthEnsureException('Username should not be empty');
        }
    }
}
