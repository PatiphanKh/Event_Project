<?php
// ถ้ามีการส่งฟอร์ม (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //  รับค่าจากฟอร์มที่ส่งมา
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';

    //  เรียกใช้ฟังก์ชันบันทึกลง Database ใน user_model
    $is_success = registerUser($name, $email, $password, $gender, $birth_date);

    //  เช็คว่าบันทึกสำเร็จไหม
    if ($is_success) {
        // ถ้าสำเร็จ สั่งเด้งไปหน้า login
        header('Location: /login');
        exit;
    } else {
        // ถ้าไม่สำเร็จ 
        echo "<script>alert('เกิดข้อผิดพลาดในการสมัครสมาชิก กรุณาลองใหม่อีกครั้ง');</script>";
    }
}

// ถ้าเป็นการเข้าหน้าเว็บปกติ ให้แสดงฟอร์ม
require_once TEMPLATES_DIR . '/register.php';