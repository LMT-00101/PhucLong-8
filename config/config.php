<?php
/**
 * Mở kết nối đến CSDL sử dụng PDO
 */
function pdo_get_connection(){
    $dburl = "mysql:host=phlog-lmt-009.g.aivencloud.com;port=18766;dbname=phlog;charset=utf8";
    $username = 'avnadmin';
    $password = 'AVNS_Sk1B_i25czPfG_RICYG';

    $conn = new PDO($dburl, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
