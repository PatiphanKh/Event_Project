<?php
$eid = $_GET['id'] ?? null;

if (!$eid) {
    header('Location: /');
    exit;
}

$event = getEventById($eid);

if (!$event) {
    die("ไม่พบกิจกรรมที่คุณต้องการ");
}

// --- โค้ดที่เพิ่มเข้ามาใหม่ ---
$joinStatus = false;
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    // ดึงสถานะปัจจุบันมา (pending, approved, rejected หรือ false)
    $joinStatus = checkJoinStatus($eid, $uid);
}
// -----------------------

// ส่งตัวแปร $joinStatus ไปให้ template ด้วย
renderView('event-detail', [
    'event' => $event,
    'joinStatus' => $joinStatus
]);