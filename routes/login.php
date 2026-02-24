<?php
// 1. เชื่อมต่อฐานข้อมูล
$conn = getConnection();
die("เชื่อมต่อสำเร็จและมาถึงหน้า Login แล้ว!");

$error = "";

// 2. เช็คว่ามีการกดปุ่ม Login (ส่งข้อมูลแบบ POST) มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 3. ค้นหาผู้ใช้ในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ดึงข้อมูลผู้ใช้ออกมา
        $user = $result->fetch_assoc();
        
        // --- ส่วนที่ทำให้เกิดการแจ้งเตือน ---
        echo "<script>
                alert('ยินดีต้อนรับคุณ " . $user['name'] . " เข้าสู่ระบบสำเร็จ!');
                window.location.href = '/'; 
              </script>";
        exit; // หยุดการทำงานเพื่อไม่ให้โหลดหน้า Template ซ้ำ
    } else {
        $error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
    }
}

// 4. ถ้ายังไม่ได้กด Login หรือล็อกอินพลาด ให้แสดงหน้าฟอร์มปกติ
renderView('login', ['title' => 'Login', 'error' => $error]);