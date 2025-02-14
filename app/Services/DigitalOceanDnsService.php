<?php

namespace App\Services;

use GuzzleHttp\Client;

class DigitalOceanDnsService
{
    protected $client;
    protected $apiKey;
    protected $domain;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('DIGITALOCEAN_API_KEY');
        $this->domain = env('DIGITALOCEAN_DOMAIN');
    }

    public function setupEmailDns($domain)
    {
        $this->createDnsRecord($domain, 'MX', '@', 'mail.'.$domain);
        $this->createDnsRecord($domain, 'A', 'mail', 'YOUR_VPS_IP');
        $this->createDnsRecord($domain, 'TXT', '@', 'v=spf1 mx ~all');
        $this->createDnsRecord($domain, 'TXT', 'default._domainkey', 'YOUR_DKIM_VALUE');
        $this->createDnsRecord($domain, 'TXT', '_dmarc', 'v=DMARC1; p=none');
    }

    private function createDnsRecord($domain, $type, $name, $value)
    {
        $this->client->post("https://api.digitalocean.com/v2/domains/{$this->domain}/records", [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'type'  => $type,
                'name'  => $name,
                'data'  => $value,
                'ttl'   => 3600,
            ],
        ]);
    }
}
