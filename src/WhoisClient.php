<?php
namespace Whois;

class WhoisClient
{
    private WhoisServerMap $serverMap;

    public function __construct(WhoisServerMap $serverMap)
    {
        $this->serverMap = $serverMap;
    }

    public function query(string $domain): string
    {
        $domain = strtolower(trim($domain));
        $tld = $this->extractTld($domain);
        $server = $this->serverMap->getServerForTld($tld);

        if (!$server) {
            throw new \Exception("No WHOIS server found for TLD: $tld");
        }

        return $this->performQuery($server, $domain);
    }

    private function extractTld(string $domain): string
    {
        $parts = explode('.', $domain);
        $count = count($parts);

        for ($i = 2; $i >= 1; $i--) {
            $tld = implode('.', array_slice($parts, -$i));
            if ($this->serverMap->getServerForTld($tld)) {
                return $tld;
            }
        }

        return end($parts);
    }

    private function performQuery(string $server, string $domain): string
    {
        $fp = fsockopen($server, 43, $errno, $errstr, 10);
        if (!$fp) {
            throw new \Exception("Connection failed: $errstr ($errno)");
        }

        fwrite($fp, "$domain\r\n");
        $response = '';
        while (!feof($fp)) {
            $response .= fgets($fp, 128);
        }
        fclose($fp);
        return $response;
    }
}
