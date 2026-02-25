<?php
// 1. เชื่อมต่อฐานข้อมูล
$conn = getConnection();
$error = "";

// 2. เช็คว่ามีการกดปุ่มสมัครสมาชิก (ส่งข้อมูลแบบ POST) มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender']; // รับค่า Male, Female, หรือ Other
    $birth_date = $_POST['birth_date']; // รับค่าเป็นวันที่

    // 3. เช็คอีเมลซ้ำในระบบ
    $check_email = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($check_email->num_rows > 0) {
        $error = "อีเมลนี้มีผู้ใช้งานแล้ว กรุณาใช้อีเมลอื่น";
    } else {
        // 4. บันทึกข้อมูลลงตาราง users 
        $sql = "INSERT INTO users (name, email, password, gender, birth_date) 
                VALUES ('$name', '$email', '$password', '$gender', '$birth_date')";
        
        if ($conn->query($sql) === TRUE) {
            // สมัครสำเร็จ เด้งไปหน้า Login
            echo "<script>
                    alert('สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ');
                    window.location.href = '/login';
                  </script>";
            exit;
        } else {
            $error = "เกิดข้อผิดพลาด: " . $conn->error;
        }
    }
}

// 5. แสดงหน้าฟอร์ม
renderView('register', ['title' => 'สมัครสมาชิก', 'error' => $error]);