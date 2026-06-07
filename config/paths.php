<?php
if (!defined('BASE_PATH')) {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    define('BASE_PATH', rtrim($scriptDir, '/') . '/');
}
