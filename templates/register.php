<?php if(!empty($data['error'])) echo "<p style='color:red; font-weight:bold;'>".$data['error']."</p>"; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title><?= $data['title'] ?></title>
</head>
<body>

    <h1>สมัครสมาชิก (Register)</h1>

    <form action="" method="post">

        <div>
            <label for="name">ชื่อ-นามสกุล:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div style="margin-top: 10px;">
            <label for="gender">เพศ:</label>
            <select id="gender" name="gender" required>
                <option value="">-- กรุณาเลือก --</option>
                <option value="Male">ชาย</option>
                <option value="Female">หญิง</option>
                <option value="Other">อื่นๆ</option>
            </select>
        </div>

        <div style="margin-top: 10px;">
            <label for="birth_date">วันเกิด:</label>
            <input type="date" id="birth_date" name="birth_date" required>
        </div>

        <div style="margin-top: 10px;">
            <label for="email">อีเมล:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div style="margin-top: 10px;">
            <label for="password">รหัสผ่าน:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div style="margin-top: 20px;">
            <button type="reset">ยกเลิก</button>
            <button type="submit">ยืนยันการสมัคร</button>
        </div>

    </form>

    <p style="margin-top: 20px;">มีบัญชีอยู่แล้ว? <a href="/login">เข้าสู่ระบบที่นี่</a></p>

</body>
</html>