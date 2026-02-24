<?php if(isset($data['error'])) echo "<p style='color:red'>".$data['error']."</p>"; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title><?= $data['title'] ?></title>
</head>
<body>

    <h1>เข้าสู่ระบบ (Login)</h1>

    <form action="" method="post">
        
        <div>
            <label for="email">อีเมล:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div style="margin-top: 10px;">
            <label for="password">รหัสผ่าน:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit">ยืนยัน (Login)</button>
        </div>

    </form>

    <p>ยังไม่มีบัญชี? <a href="/register">ลงทะเบียนที่นี่</a></p>

</body>
</html>