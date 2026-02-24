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

        <div>
            <label for="gender">เพศ:</label>
            <select id="gender" name="gender" required>
                <option value="">-- กรุณาเลือก --</option>
                <option value="male">ชาย</option>
                <option value="female">หญิง</option>
                <option value="other">อื่นๆ</option>
            </select>
        </div>

        <div>
            <label for="age">อายุ:</label>
            <input type="number" id="age" name="age" min="1" max="100" required>
        </div>

        <div>
            <label for="email">อีเมล:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">รหัสผ่าน:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="phone">เบอร์โทรศัพท์:</label>
            <input type="tel" id="phone" name="phone">
        </div>

        <div style="margin-top: 20px;">
            <button type="reset">ยกเลิก</button> <button type="submit">ยืนยันการสมัคร</button> </div>

    </form>

    <p>มีบัญชีอยู่แล้ว? <a href="/login">เข้าสู่ระบบที่นี่</a></p>

</body>
</html>