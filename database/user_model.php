<?php

// ฟังก์ชันเช็กการเข้าสู่ระบบ (ใช้ password_verify แทนการเทียบ ==)
function loginUser($email, $password)
{
    $conn = getConnection();
    
    // ดึงข้อมูล User ด้วยอีเมลมาก่อน
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // 💡 เช็กว่ารหัสผ่านที่พิมพ์มา (Plain text) ตรงกับ Hash ใน Database ไหม
        if (password_verify($password, $user['password'])) {
            return $user; // รหัสถูก คืนค่าข้อมูล User
        }
    }
    
    return false; // อีเมลไม่เจอ หรือ รหัสผิด
}

// ==========================================
// ฟังก์ชัน สมัครสมาชิก (แปลงรหัสเป็น Hash ก่อนเซฟ)
// ==========================================
function registerUser($name, $email, $password, $gender, $birth_date)
{
    $conn = getConnection();
    
    // 💡 นำรหัสผ่านที่รับมา เข้ากระบวนการ Hash เพื่อความปลอดภัย
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, gender, birth_date) VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

    // 💡 เปลี่ยนมาใช้ $hashedPassword บันทึกลงฐานข้อมูลแทน $password ปกติ
    $stmt->bind_param("sssss", $name, $email, $hashedPassword, $gender, $birth_date);
    
    return $stmt->execute();
}