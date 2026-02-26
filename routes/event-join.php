<?php
// บังคับล็อกอิน
if (!isset($_SESSION['uid'])) {
    header('Location: /login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eid = $_POST['eid'] ?? null;
    $uid = $_SESSION['uid'];

    if ($eid) {
        // เช็กก่อนว่าเคยขอไปแล้วหรือยัง กันการกดเบิ้ล
        $currentStatus = checkJoinStatus($eid, $uid);
        
        if (!$currentStatus) {
            // ถ้ายังไม่เคยขอ ให้บันทึกลงฐานข้อมูล
            requestToJoinEvent($eid, $uid);
        }
    }
    
    // เด้งกลับไปหน้าดูรายละเอียดกิจกรรมเดิม
    header("Location: /event-detail?id=" . $eid);
    exit;
}