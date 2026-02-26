<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการกิจกรรม (Event Management)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

    <header class="bg-[#6B8CFF] px-4 md:px-8 py-4 flex flex-col md:flex-row items-center justify-between w-full shadow-md gap-4">
        
        <div class="flex items-center gap-6 w-full md:w-auto justify-center md:justify-start">
            <a href="/" class="text-white text-3xl font-bold hover:opacity-80 transition">
                EventHub
            </a>
            
            <?php if (isset($_SESSION['uid'])): ?>
                <nav class="hidden lg:flex gap-4 text-white font-medium text-sm">
                    <a href="/event-create" class="hover:text-gray-200 transition">สร้างกิจกรรม</a>
                    <a href="/my-events" class="hover:text-gray-200 transition">กิจกรรมที่ฉันสร้าง</a>
                    <a href="/joined-events" class="text-[#FFD700] hover:text-yellow-200 transition">กิจกรรมที่เข้าร่วม</a>
                </nav>
            <?php endif; ?>
        </div>
        <div class="flex items-center gap-4 w-full md:w-auto justify-center md:justify-end">
            <?php if (isset($_SESSION['uid'])): ?>
                <span class="text-white font-medium hidden sm:block">สวัสดี, ผู้ใช้ #<?= $_SESSION['uid'] ?></span>
                <a href="/logout" class="bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition duration-200 shadow-sm whitespace-nowrap">
                    ออกจากระบบ
                </a>
            <?php else: ?>
                <a href="/register" class="bg-[#34F874] text-black px-5 py-2 rounded-lg hover:opacity-80 transition duration-200 shadow-sm whitespace-nowrap font-medium">
                    สมัครสมาชิก
                </a>
                <a href="/login" class="bg-[#00D1FF] text-black px-5 py-2 rounded-lg hover:opacity-80 transition duration-200 shadow-sm whitespace-nowrap font-medium">
                    เข้าสู่ระบบ
                </a>
            <?php endif; ?>
        </div>
        
        <?php if (isset($_SESSION['uid'])): ?>
            <nav class="flex lg:hidden w-full justify-center gap-4 text-white font-medium text-sm mt-2 flex-wrap">
                <a href="/event-create" class="hover:text-gray-200">สร้างกิจกรรม</a>
                <a href="/my-events" class="hover:text-gray-200">กิจกรรมที่ฉันสร้าง</a>
                <a href="/joined-events" class="text-[#FFD700] hover:text-yellow-200">กิจกรรมที่เข้าร่วม</a>
            </nav>
        <?php endif; ?>

    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        </main>

</body>

</html>