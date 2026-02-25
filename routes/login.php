<?php
// 1. เชื่อมต่อฐานข้อมูล
$conn = getConnection(); 
$error = "";

// 2. เช็คว่ามีการกดปุ่ม Login มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 3. ค้นหาผู้ใช้จากอีเมลและรหัสผ่าน
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ดึงข้อมูลผู้ใช้ออกมา
        $user = $result->fetch_assoc();
        
        // เก็บค่า uid (ตามที่เพื่อนออกแบบ) และ name ไว้ใน Session
        $_SESSION['user_uid'] = $user['uid']; 
        $_SESSION['user_name'] = $user['name'];
        
        // แจ้งเตือนและเด้งไปหน้าแรก
        echo "<script>
                alert('ยินดีต้อนรับคุณ " . $user['name'] . " เข้าสู่ระบบสำเร็จ!');
                window.location.href = '/'; 
              </script>";
        exit;
    } else {
        $error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
    }
}

// 4. แสดงหน้าฟอร์มปกติ
renderView('login', ['title' => 'เข้าสู่ระบบ', 'error' => $error]);