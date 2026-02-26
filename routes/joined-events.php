<?php
// บังคับว่าต้องล็อกอินก่อนถึงจะดูหน้านี้ได้
if (!isset($_SESSION['uid'])) {
    header('Location: /login');
    exit;
}

$uid = $_SESSION['uid'];

// ดึงข้อมูลกิจกรรมที่เราเข้าร่วมทั้งหมด
$events = getJoinedEvents($uid);

// ส่งข้อมูลไปแสดงผลที่หน้าจอ
renderView('joined-events', [
    'events' => $events
]);