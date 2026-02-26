<?php include 'header.php'; ?>

<div class="my-8 flex flex-col sm:flex-row justify-between items-center gap-4">
    <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
        <span>⭐</span> กิจกรรมที่เข้าร่วม
    </h2>
    <a href="/" class="bg-[#00D1FF] text-black px-6 py-2.5 rounded-xl font-bold hover:opacity-80 transition shadow-sm">
        กิจกรรมเพิ่มเติม
    </a>
</div>

<?php if (empty($events)): ?>
    <div class="bg-white rounded-3xl shadow-sm border border-dashed border-gray-300 text-center py-16">
        <h4 class="text-xl text-gray-500 font-medium mb-4">คุณยังไม่ได้เข้าร่วมกิจกรรมใดๆ เลย</h4>
        <a href="/" class="bg-[#34F874] text-black px-6 py-3 rounded-full font-bold hover:opacity-80 transition shadow-sm">ไปดูกิจกรรมที่น่าสนใจกันเถอะ!</a>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <?php foreach ($events as $event): ?>
            <div class="bg-white rounded-3xl shadow-md overflow-hidden flex flex-col border border-gray-100 hover:shadow-lg transition">
                <div class="p-6 flex flex-col flex-grow">
                    
                    <div class="mb-4">
                        <?php if ($event['join_status'] == 'pending'): ?>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">⏳ รอการอนุมัติ</span>
                        <?php elseif ($event['join_status'] == 'approved'): ?>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold border border-green-200">✅ เข้าร่วมแล้ว</span>
                        <?php elseif ($event['join_status'] == 'rejected'): ?>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold border border-red-200">❌ ถูกปฏิเสธ</span>
                        <?php endif; ?>
                    </div>

                    <h5 class="text-xl font-bold text-gray-800 mb-2 truncate" title="<?= htmlspecialchars($event['name']) ?>">
                        <?= htmlspecialchars($event['name']) ?>
                    </h5>
                    
                    <p class="text-sm text-gray-600 mb-6 flex-grow">
                        <span class="font-semibold">📅 จัดเมื่อ:</span> <br>
                        <?= date('d/m/Y', strtotime($event['start_date'])) ?> ถึง <?= date('d/m/Y', strtotime($event['end_date'])) ?>
                    </p>
                    
                    <a href="/event-detail?id=<?= $event['eid'] ?>" class="text-center w-full bg-blue-50 text-blue-600 border border-blue-200 px-4 py-2.5 rounded-xl font-bold hover:bg-blue-100 transition mt-auto">
                        ดูรายละเอียด
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include 'footer.php'; ?>