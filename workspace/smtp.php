<?php
$config = require '/var/www/html/hack/auth.php';  // Absolute path
$auth= $config['smtp_auth'];
return [
    'smtp_host' => 'smtpout.secureserver.net',
    'smtp_user' => 'info@gocosys.com',
    'smtp_pass' => $auth,
    'smtp_port' => 465,
];

?>