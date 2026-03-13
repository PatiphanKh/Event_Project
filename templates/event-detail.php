<?php include 'header.php'; ?>

<div class="flex-grow flex items-center justify-center p-4 min-h-[80vh] py-10">
    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-lg w-full max-w-4xl border-2 border-[#00D1FF]">

        <h2 class="text-3xl md:text-4xl font-bold text-[#6B8CFF] mb-6"><?= htmlspecialchars($event['name']) ?></h2>

        <div class="bg-blue-50 p-6 rounded-2xl mb-8 space-y-3 text-gray-700 font-medium">
            <p class="flex items-center gap-2"><span class="text-xl">🟢</span> <strong>เริ่ม:</strong> <?= date('d/m/Y เวลา ', strtotime($event['start_date'])) ?></p>
            <p class="flex items-center gap-2"><span class="text-xl">🔴</span> <strong>สิ้นสุด:</strong> <?= date('d/m/Y เวลา ', strtotime($event['end_date'])) ?></p>
            <p class="flex items-center gap-2"><span class="text-xl">👥</span> <strong>รับจำนวน:</strong> <?= number_format($event['quantity']) ?> คน</p>
        </div>

        <h5 class="text-2xl font-bold mb-4 text-gray-800">รายละเอียดกิจกรรม</h5>
        <p class="text-gray-600 leading-relaxed whitespace-pre-line mb-10 text-lg">
            <?= htmlspecialchars($event['description']) ?>
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4 border-t pt-8">
            <?php if (!isset($_SESSION['uid'])): ?>
                <a href="/login" class="bg-[#00D1FF] text-black px-8 py-3 rounded-full font-bold hover:opacity-80 transition shadow-md text-center">เข้าสู่ระบบเพื่อเข้าร่วม</a>

            <?php elseif ($event['creator_uid'] == $_SESSION['uid']): ?>
                <button class="bg-gray-400 text-white px-8 py-3 rounded-full font-bold cursor-not-allowed text-center">คุณเป็นผู้สร้างกิจกรรมนี้</button>
                 <a href="/event-edit?id=<?= (int)$event['eid'] ?>" class="bg-green-500 text-white px-8 py-3 rounded-full font-bold hover:bg-green-600 transition shadow-sm text-center">แก้ไขกิจกรรม</a>
            <?php else: ?>
                <?php if (isset($joinStatus) && $joinStatus === 'pending'): ?>
                    <button class="bg-yellow-400 text-black px-8 py-3 rounded-full font-bold cursor-not-allowed shadow-md text-center">⏳ รอการอนุมัติ</button>
                <?php elseif (isset($joinStatus) && $joinStatus === 'approved'): ?>
                    <form action="/event-otp-send" method="POST" class="w-full sm:w-auto">
                        <input type="hidden" name="eid" value="<?= htmlspecialchars($event['eid']) ?>">
                        <button type="submit" class="w-full sm:w-auto bg-green-500 text-white px-8 py-3 rounded-full font-bold hover:opacity-80 transition shadow-md">
                            รับ OTP ทางอีเมล
                        </button>
                    </form>
                <?php elseif (isset($joinStatus) && $joinStatus === 'rejected'): ?>
                    <button class="bg-red-500 text-white px-8 py-3 rounded-full font-bold cursor-not-allowed shadow-md text-center">❌ คำขอถูกปฏิเสธ</button>
                <?php else: ?>
                    <form action="/event-join" method="POST" class="w-full sm:w-auto">
                        <input type="hidden" name="eid" value="<?= htmlspecialchars($event['eid']) ?>">
                        <button type="submit" class="w-full sm:w-auto bg-[#34F874] text-black px-8 py-3 rounded-full font-bold hover:opacity-80 transition shadow-md" onclick="return confirm('ต้องการส่งคำขอเข้าร่วมกิจกรรมนี้ใช่หรือไม่?');">
                            ขอเข้าร่วมกิจกรรม
                        </button>
                    </form>
                    <?php if (!empty($_GET['msg'])): ?>
                        <div class="mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-xl px-4 py-2">
                            <?= htmlspecialchars($_GET['msg']) ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

            <a href="/" class="bg-gray-200 text-gray-800 px-8 py-3 rounded-full font-bold hover:bg-gray-300 transition shadow-sm text-center">กลับหน้าหลัก</a>
           
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>