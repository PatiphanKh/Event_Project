<?php

// 1. บังคับล็อกอินก่อน
if (!isset($_SESSION['uid'])) {
    header('Location: /login');
    exit;
}

// 2. รับค่า ID กิจกรรมที่ส่งมาทาง URL (เช่น id=3)
$eid = $_GET['id'] ?? null;
// รับ ID ของคนที่ล็อกอินอยู่
$uid = $_SESSION['uid'];

// 3. ถ้ามี ID ส่งมา ให้เรียกฟังก์ชันลบ
if ($eid) {
    deleteEvent($eid, $uid);
}

// 4. ลบเสร็จปุ๊บ สั่งให้เด้งกลับไปหน้า "กิจกรรมของฉัน" ทันที
header('Location: /my-events');
exit;