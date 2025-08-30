<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../src/WhoisClient.php';
require_once __DIR__ . '/../src/WhoisServerMap.php';

use Whois\WhoisClient;
use Whois\WhoisServerMap;

$domain = $_GET['domain'] ?? $_POST['domain'] ?? '';

if (!$domain) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing domain parameter']);
    exit;
}

try {
    $map = new WhoisServerMap(__DIR__ . '/../config/whois_servers.php');
    $client = new WhoisClient($map);
    $result = $client->query($domain);

    echo json_encode([
        'domain' => $domain,
        'whois' => $result
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
