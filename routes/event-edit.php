<?php
// บังคับล็อกอิน
if (!isset($_SESSION['uid'])) {
    header('Location: /login');
    exit;
}

$error = '';
$success = '';
$uid = $_SESSION['uid'];

$eid = $_GET['id'] ?? $_POST['id'] ?? 0;
$event = getEventById($eid);

// เช็กว่ามีสิทธิ์แก้ไขไหม
if (!$event || $event['creator_uid'] != $uid) {
    header('Location: /my-events');
    exit;
}

// ==========================================
// ส่วนจัดการ: ลบรูปภาพ (ถ้ามีการกดปุ่มลบรูป)
// ==========================================
if (isset($_GET['delete_img'])) {
    $imgid = $_GET['delete_img'];
    if (deleteEventImage($imgid, $eid)) {
        // ลบเสร็จให้รีเฟรชหน้าตัวเอง 1 รอบ เพื่อให้รูปหายไป
        header("Location: /event-edit?id=" . $eid . "&msg=deleted");
        exit;
    }
}

// รับข้อความแจ้งเตือนถ้าลบรูปสำเร็จ
if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') {
    $success = 'ลบรูปภาพสำเร็จ!';
}

// ==========================================
// ส่วนจัดการ: บันทึกข้อมูลและอัปโหลดรูปเพิ่ม
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $quantity = $_POST['quantity'] ?? 0;
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';

    // อัปเดตข้อมูลข้อความ
    if (updateEvent($eid, $uid, $name, $description, $quantity, $start_date, $end_date)) {
        
        // อัปโหลดรูปภาพ (เพิ่มเข้าไปใหม่)
        // ใช้ __DIR__ . '/../' เพื่อถอยหลังออกมา 1 โฟลเดอร์ ให้อยู่หน้าสุดของโปรเจกต์
        $uploadDir = 'uploads/'; 
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $fileCount = count($_FILES['images']['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                $tmpName = $_FILES['images']['tmp_name'][$i];
                $fileName = time() . '_' . basename($_FILES['images']['name'][$i]);
                
                // พาธสำหรับย้ายไฟล์ในเครื่อง Server (Mac ของคุณ)
                $targetFilePath = $uploadDir . $fileName; 
                
                // พาธสำหรับเซฟลง Database (เพื่อให้หน้าเว็บดึงไปโชว์ได้ถูกต้อง)
                $dbFilePath = '/uploads/' . $fileName; 

                if (move_uploaded_file($tmpName, $targetFilePath)) {
                    addEventImage($eid, $dbFilePath); // เซฟลง DB
                }
            }
        }

        $success = 'อัปเดตกิจกรรมและรูปภาพสำเร็จ! 🎉';
        $event = getEventById($eid); // ดึงข้อมูลใหม่มาโชว์
    } else {
        $error = 'เกิดข้อผิดพลาดในการอัปเดต กรุณาลองใหม่';
    }
}

// ดึงรูปภาพทั้งหมดของกิจกรรมนี้มาแสดง
$eventImages = getEventImages($eid);

// โหลดหน้าจอ UI และส่งตัวแปร $eventImages ไปด้วย
renderView('event-edit', [
    'event' => $event,
    'eventImages' => $eventImages,
    'error' => $error,
    'success' => $success
]);