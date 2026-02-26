<?php
// บังคับว่า "ต้องล็อกอินก่อน"
if (!isset($_SESSION['uid'])) {
    header('Location: /login');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $quantity = $_POST['quantity'] ?? 0;
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    
    $uid = $_SESSION['uid']; 

    // 1. สร้างกิจกรรมลงตาราง events ก่อน
    $eventId = createEvent($uid, $name, $description, $quantity, $start_date, $end_date);

    if ($eventId) {
        // 2. จัดการอัปโหลดรูปภาพ
        // (สมมติว่าไฟล์ index.php ของคุณอยู่ในโฟลเดอร์ public เราจะสร้างโฟลเดอร์ uploads ไว้ในนั้น)
        $uploadDir = 'uploads/'; 
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // เช็กว่ามีการแนบไฟล์มาไหม
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $fileCount = count($_FILES['images']['name']);
            
            for ($i = 0; $i < $fileCount; $i++) {
                $tmpName = $_FILES['images']['tmp_name'][$i];
                $fileName = time() . '_' . basename($_FILES['images']['name'][$i]);
                $targetFilePath = $uploadDir . $fileName;

                // ย้ายไฟล์รูปที่อัปโหลดมาไปไว้ในโฟลเดอร์ uploads/
                if (move_uploaded_file($tmpName, $targetFilePath)) {
                    // เซฟชื่อไฟล์ลงตาราง event_imgs โดยเพิ่ม / นำหน้าเพื่อใช้แสดงผลในหน้าเว็บ
                    addEventImage($eventId, '/' . $targetFilePath);
                }
            }
        }
        
        $success = 'สร้างกิจกรรมและอัปโหลดรูปภาพสำเร็จ! 🎉';
    } else {
        $error = 'เกิดข้อผิดพลาดในการสร้างกิจกรรม กรุณาลองใหม่';
    }
}

renderView('event-create', [
    'error' => $error,
    'success' => $success
]);