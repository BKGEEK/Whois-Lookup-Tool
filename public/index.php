<?php
require_once __DIR__ . '/../src/WhoisClient.php';
require_once __DIR__ . '/../src/WhoisServerMap.php';

use Whois\WhoisClient;
use Whois\WhoisServerMap;

$domain = $_POST['domain'] ?? '';
$result = '';

if ($domain) {
    try {
        $map = new WhoisServerMap(__DIR__ . '/../config/whois_servers.php');
        $client = new WhoisClient($map);
        $result = $client->query($domain);
    } catch (Exception $e) {
        $result = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WHOIS 查询</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>WHOIS 查询</h1>
        <form method="post" class="search-form">
            <input type="text" name="domain" placeholder="请输入域名" required class="search-input">
            <button type="submit" class="search-button">查询</button>
        </form>

        <?php if ($result): ?>
            <h2>查询结果：</h2>
            <pre><?= htmlspecialchars($result) ?></pre>
        <?php endif; ?>
        
        <footer class="footer">
            <p>&copy; <?= date('Y') ?> WHOIS查询工具 Orgv.EU Team版权所有 严打倒卖 必须注明原作者 二开需授权</p>
        </footer>
    </div>
</body>
</html>
