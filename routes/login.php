<?php

// ถ้าล็อกอินอยู่แล้ว (มี Session) ให้เด้งกลับไปหน้าแรกเลย
if (isset($_SESSION['uid'])) {
    header('Location: /');
    exit;
}

$error = '';

// ถ้ามีการกดปุ่ม "เข้าสู่ระบบ" (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // เรียกฟังก์ชันใน user_model.php เพื่อเช็ก Database
    $user = loginUser($email, $password);

    if ($user) {
        // ล็อกอินสำเร็จ! เก็บข้อมูลลง Session
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['name'] = $user['name'];
        
        // สั่งให้เด้ง (Redirect) ไปหน้าแรก
        header('Location: /');
        exit;
    } else {
        // ล็อกอินไม่สำเร็จ
        $error = 'อีเมล หรือรหัสผ่านไม่ถูกต้อง!';
    }
}

// ถ้าไม่ได้กด Submit หรือล็อกอินผิด ให้แสดงหน้าฟอร์ม Login พร้อมข้อความ Error (ถ้ามี)
renderView('login', ['error' => $error]);