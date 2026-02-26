<?php 
// เช็คข้อความ Error ตอนสมัครสมาชิก
if(!empty($data['error'])) {
    echo "<script>alert('".$data['error']."');</script>"; 
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'สมัครสมาชิก' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F2F2F2] font-sans h-screen flex flex-col">

    <?php include 'navbar.php'; ?>

    <main class="flex-grow flex items-center justify-center p-4">
        
        <div class="bg-white p-10 rounded-3xl shadow-lg w-full max-w-md border-2 border-[#00D1FF]">
            
            <h2 class="text-3xl font-bold text-center mb-8">Register</h2>

            <form action="" method="post" class="space-y-4">
                
                <div>
                    <input type="text" name="name" placeholder="ชื่อ" required
                           class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>

                <div class="relative">
                    <select name="gender" required
                            class="w-full bg-[#E6E6E6] text-gray-500 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition appearance-none">
                        <option value="" disabled selected>เพศ</option>
                        <option value="Male">ชาย</option>
                        <option value="Female">หญิง</option>
                        <option value="Other">อื่นๆ</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <div>
                    <input type="date" name="birth_date" required
                           class="w-full bg-[#E6E6E6] text-gray-500 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>

                <div>
                    <input type="email" name="email" placeholder="อีเมล" required
                           class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>

                <div>
                    <input type="password" name="password" placeholder="รหัสผ่าน" required
                           class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>

                <div class="flex justify-center gap-6 pt-4">
                    <button type="reset" class="bg-[#FF0000] text-white px-8 py-2 rounded-full font-bold hover:opacity-80 transition shadow-md">
                        ยกเลิก
                    </button>
                    <button type="submit" class="bg-[#00FF00] text-black px-8 py-2 rounded-full font-bold hover:opacity-80 transition shadow-md">
                        ยืนยัน
                    </button>
                </div>

            </form>

            <div class="text-center mt-6 text-xs text-gray-800 font-semibold">
                มีบัญชีอยู่แล้ว? <a href="/login" class="text-blue-500 hover:underline">เข้าสู่ระบบที่นี่</a>
            </div>

        </div>

    </main>

</body>
</html>