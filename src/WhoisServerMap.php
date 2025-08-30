<?php
namespace Whois;

class WhoisServerMap
{
    private array $map;

    public function __construct(string $configPath)
    {
        $this->map = require $configPath;
    }

    public function getServerForTld(string $tld): ?string
    {
        return $this->map[strtolower($tld)] ?? null;
    }

    public function getSupportedTlds(): array
    {
        return array_keys($this->map);
    }
}
