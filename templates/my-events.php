<?php include 'header.php'; ?>

<div class="my-8 flex flex-col sm:flex-row justify-between items-center gap-4">
    <h2 class="text-3xl font-bold text-gray-800">กิจกรรมของฉัน</h2>
    <a href="/event-create" class="bg-[#34F874] text-black px-6 py-3 rounded-xl font-bold hover:opacity-80 transition shadow-sm whitespace-nowrap">
        + สร้างกิจกรรมใหม่
    </a>
</div>

<div class="bg-white rounded-3xl shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#6B8CFF] text-white">
                    <th class="p-4 font-semibold text-lg rounded-tl-3xl">ชื่องาน</th>
                    <th class="p-4 font-semibold text-lg">วันที่เริ่ม</th>
                    <th class="p-4 font-semibold text-lg text-center">รับสมัคร</th>
                    <th class="p-4 font-semibold text-lg text-center rounded-tr-3xl">จัดการ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (empty($events)): ?>
                    <tr>
                        <td colspan="4" class="text-center p-10 text-gray-500">
                            ยังไม่มีกิจกรรมที่คุณสร้าง <br>
                            <a href="/event-create" class="text-blue-500 hover:underline mt-2 inline-block">สร้างกิจกรรมแรก</a>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <tr class="hover:bg-blue-50 transition duration-150">
                            <td class="p-4 font-bold text-gray-800"><?= htmlspecialchars($event['name']) ?></td>
                            <td class="p-4 text-gray-600"><?= date('d/m/Y H:i', strtotime($event['start_date'])) ?></td>
                            <td class="p-4 text-center text-gray-600"><?= number_format($event['quantity']) ?></td>
                            <td class="p-4">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="/event-manage?id=<?= $event['eid'] ?>" class="bg-[#00D1FF] text-black px-3 py-1.5 rounded-lg text-sm font-semibold hover:opacity-80 shadow-sm">ผู้เข้าร่วม</a>
                                    <a href="/event-detail?id=<?= $event['eid'] ?>" class="bg-blue-500 text-white px-3 py-1.5 rounded-lg text-sm font-semibold hover:bg-blue-600 shadow-sm">ดู</a>
                                    <a href="/event-edit?id=<?= $event['eid'] ?>" class="bg-yellow-400 text-black px-3 py-1.5 rounded-lg text-sm font-semibold hover:bg-yellow-500 shadow-sm">แก้ไข</a>
                                    <a href="/event-delete?id=<?= $event['eid'] ?>" class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-sm font-semibold hover:bg-red-600 shadow-sm" onclick="return confirm('แน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?');">ลบ</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>