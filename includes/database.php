<?php
// ข้อมูลเชื่อมต่อ Hostinger
$hostname = 'auth-db1762.hstgr.io';
$username = 'u910454988_dbevent';
$password = 'zX&u/z#GAVK5z!K8';
$dbName = 'u910454988_dbevent';

mysqli_report(MYSQLI_REPORT_OFF);

$conn = @new mysqli($hostname, $username, $password, $dbName);

function getConnection(): mysqli
{
    global $conn;
    if ($conn->connect_error) {
        die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4"); 
    return $conn;
}

// ==========================================
// ส่วนดึงไฟล์ฟังก์ชันจัดการ Database ต่างๆ (Models)
// ==========================================
// ==========================================
// ส่วนดึงไฟล์ฟังก์ชันจัดการ Database ต่างๆ (Models)
// ==========================================
require_once __DIR__ . '/../database/event_model.php';
require_once __DIR__ . '/../database/user_model.php';