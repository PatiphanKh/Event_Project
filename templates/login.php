<<<<<<< HEAD
<?php 
// เช็คว่ามีข้อความ Error จากระบบหลังบ้านส่งมาหรือไม่ ถ้ามีให้เด้งแจ้งเตือน
if(!empty($data['error'])) {
    echo "<script>alert('".$data['error']."');</script>"; 
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'เข้าสู่ระบบ' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F2F2F2] font-sans h-screen flex flex-col">

    <?php include 'navbar.php'; ?>

    <main class="flex-grow flex items-center justify-center p-4">
        
        <div class="bg-white p-10 rounded-3xl shadow-lg w-full max-w-md border-2 border-[#00D1FF]">
            
            <h2 class="text-3xl font-bold text-center mb-8">Login</h2>

            <form action="" method="post" class="space-y-5">
                
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
                ยังไม่มีบัญชี <a href="/register" class="text-blue-500 hover:underline">ลงทะเบียน</a>
            </div>

        </div>

    </main>

</body>
</html>
=======
<?php include 'header.php'; ?>

<div class="flex-grow flex items-center justify-center p-4 min-h-[70vh]">
    
    <div class="bg-white p-10 rounded-3xl shadow-lg w-full max-w-md border-2 border-[#00D1FF]">
        
        <h2 class="text-3xl font-bold text-center mb-8">Login</h2>

        <?php if(!empty($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6 text-center text-sm font-medium">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-5">
            
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
            ยังไม่มีบัญชี <a href="/register" class="text-blue-500 hover:underline">ลงทะเบียน</a>
        </div>

    </div>

</div>

<?php include 'footer.php'; ?>
>>>>>>> 0049ad538480f67298bc78651f4c65acbae33acc
