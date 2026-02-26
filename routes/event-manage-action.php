<?php
// บังคับล็อกอิน
if (!isset($_SESSION['uid'])) { header('Location: /login'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eid = $_POST['eid'] ?? null;
    $target_uid = $_POST['uid'] ?? null;
    $action = $_POST['action'] ?? null; // จะส่งมาเป็น 'approve' หรือ 'reject'

    if ($eid && $target_uid && $action) {
        // เช็กเพื่อความปลอดภัยว่า คนที่กำลังกดอนุมัติ คือเจ้าของกิจกรรมจริงๆ 
        $event = getEventById($eid);
        if ($event && $event['creator_uid'] == $_SESSION['uid']) {
            
            // กำหนดสถานะใหม่ตามปุ่มที่กด
            $new_status = ($action === 'approve') ? 'approved' : 'rejected';
            
            // อัปเดตลงฐานข้อมูล
            updateJoinStatus($eid, $target_uid, $new_status);
        }
    }
    
    // ทำเสร็จปุ๊บ เด้งกลับมาหน้าจัดการเหมือนเดิม
    header("Location: /event-manage?id=" . $eid);
    exit;
}