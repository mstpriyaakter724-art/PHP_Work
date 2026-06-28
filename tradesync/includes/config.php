<?php
// =============================================
// TradeSync – Database Configuration
// includes/config.php
// =============================================

define('DB_HOST',     'localhost');
define('DB_USER',     'root');        // Change to your MySQL username
define('DB_PASS',     '');            // Change to your MySQL password
define('DB_NAME',     'tradesync');
define('DB_CHARSET',  'utf8mb4');

define('APP_NAME',    'TradeSync');
define('APP_URL',     'http://localhost/tradesync');
define('APP_VERSION', '1.0.0');

// Session timeout in seconds (30 minutes)
define('SESSION_TIMEOUT', 1800);

// Timezone
date_default_timezone_set('Asia/Dhaka');

// Error reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
