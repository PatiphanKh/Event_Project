<?php
// ข้อมูลเชื่อมต่อ Hostinger
$hostname = 'auth-db1762.hstgr.io';
$username = 'u910454988_dbevent';
$password = 'zX&u/z#GAVK5z!K8';
$dbName = 'u910454988_dbevent';

$conn = new mysqli($hostname, $username, $password, $dbName);

// ตั้งค่าภาษาไทย
$conn->set_charset("utf8mb4");

function getConnection(): mysqli {
    global $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}