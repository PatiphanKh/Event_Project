<?php

// บังคับล็อกอิน ถ้ายังไม่ล็อกอินให้เด้งไปหน้า login
if (!isset($_SESSION['uid'])) {
    header('Location: /login');
    exit;
}

// ดึง ID ผู้ใช้ปัจจุบันจาก Session
$uid = $_SESSION['uid'];

// เรียกฟังก์ชันดึงข้อมูลกิจกรรมของฉัน
$myEvents = getMyEvents($uid);

// ส่งข้อมูลไปที่หน้า Template
renderView('my-events', [
    'events' => $myEvents
]);