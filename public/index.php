<?php

declare(strict_types=1);
session_start();

// กำหนดค่าคงที่สำหรับไดเรกทอรีต่างๆ ในโปรเจค
const INCLUDES_DIR = __DIR__ . '/../includes';
const ROUTE_DIR = __DIR__ . '/../routes';
const TEMPLATES_DIR = __DIR__ . '/../templates';
const DATABASES_DIR = __DIR__ . '/../databases';

// รวมไฟล์ที่จำเป็น เข้ามาใช้งานใน index.php
require_once INCLUDES_DIR . '/router.php';
require_once INCLUDES_DIR . '/view.php';
require_once INCLUDES_DIR . '/database.php';

// เรียก database ฟังก์ชันเพื่อเชื่อมต่อฐานข้อมูล (ถ้าจำเป็น)

// =========================================================
// เพิ่มส่วนนี้: จัดการ URL ให้รองรับการรันผ่าน XAMPP (โฟลเดอร์ย่อย)
// =========================================================
$basePath = dirname($_SERVER['SCRIPT_NAME']); // หาที่อยู่โฟลเดอร์ปัจจุบัน
$requestUri = $_SERVER['REQUEST_URI'];        // URL ที่ผู้ใช้พิมพ์เข้ามา

// รับค่า URL แบบ Hybrid (รองรับทั้ง XAMPP และ VS Code PHP Server)
if (isset($_GET['url'])) {
    $url = $_GET['url']; // สำหรับคนรันผ่าน XAMPP (.htaccess)
} else {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // สำหรับคนรันผ่าน VS Code Extension
}
// =========================================================


// ทุกครั้งที่มีการร้องขอเข้ามา ให้เรียกใช้ฟังก์ชัน dispatch
dispatch($url, $_SERVER['REQUEST_METHOD']);

//dispatch($_SERVER['REQUEST_URI'], $url, $_SERVER['REQUEST_METHOD']);

// ควบคุมการเข้าถึงหน้าเว็บด้วย session (ตัวอย่างการใช้งาน)
// const PUBLIC_ROUTES = ['/', '/login'];

// if (in_array(strtolower($_SERVER['REQUEST_URI']), PUBLIC_ROUTES)) {
//     dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
//     exit;
// } elseif (isset($_SESSION['timestamp']) && time() - $_SESSION['timestamp'] < 10) {
//     // 10 Sec.
//     $unix_timestamp = time();
//     $_SESSION['timestamp'] = $unix_timestamp;
//     dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
// } else {
//     unset($_SESSION['timestamp']);
//     header('Location: /');
//     exit;
// }