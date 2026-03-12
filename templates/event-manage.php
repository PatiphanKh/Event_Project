<?php include 'header.php'; ?>

<div class="my-8">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h3 class="text-2xl font-bold text-[#6B8CFF]">จัดการผู้เข้าร่วม: <span class="text-gray-800"><?= htmlspecialchars($event['name']) ?></span></h3>
        <a href="/my-events" class="bg-gray-200 text-gray-800 px-6 py-2.5 rounded-xl font-bold hover:bg-gray-300 transition shadow-sm whitespace-nowrap">กลับหน้ารวมกิจกรรม</a>
    </div>

    <div class="bg-white rounded-3xl shadow-md overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-6 py-4 font-bold text-lg rounded-tl-3xl">ชื่อ-นามสกุล</th>
                        <th class="px-6 py-4 font-bold text-lg">อีเมล</th>
                        <th class="px-6 py-4 font-bold text-lg text-center">สถานะ</th>
                        <th class="px-6 py-4 font-bold text-lg text-center rounded-tr-3xl">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if (empty($participants)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-500 font-medium">ยังไม่มีผู้ขอเข้าร่วมกิจกรรมนี้</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($participants as $p): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-semibold text-gray-800"><?= htmlspecialchars($p['name']) ?></td>
                                <td class="px-6 py-4 text-gray-600"><?= htmlspecialchars($p['email']) ?></td>
                                <td class="px-6 py-4 text-center">
                                    <?php
                                    if ($p['status'] == 'pending') echo '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">รออนุมัติ</span>';
                                    elseif ($p['status'] == 'approved') echo '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold border border-green-200">อนุมัติแล้ว</span>';
                                    elseif ($p['status'] == 'rejected') echo '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold border border-red-200">ปฏิเสธ</span>';
                                    ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php if ($p['status'] == 'pending'): ?>
                                        <form action="/event-manage-action" method="POST" class="flex justify-center gap-2">
                                            <input type="hidden" name="eid" value="<?= $event['eid'] ?>">
                                            <input type="hidden" name="uid" value="<?= $p['uid'] ?>">

                                            <button type="submit" name="action" value="approve" class="bg-[#34F874] text-black px-4 py-1.5 rounded-lg text-sm font-bold hover:opacity-80 shadow-sm">อนุมัติ</button>
                                            <button type="submit" name="action" value="reject" class="bg-[#FF0000] text-white px-4 py-1.5 rounded-lg text-sm font-bold hover:opacity-80 shadow-sm" onclick="return confirm('ต้องการปฏิเสธคนนี้ใช่ไหม?');">ปฏิเสธ</button>
                                        </form>
                                    <?php elseif ($p['status'] == 'approved'): ?>
                                        <a href="/event-otp-view?eid=<?= (int)$event['eid'] ?>&uid=<?= (int)$p['uid'] ?>"
                                            class="bg-blue-500 text-white px-4 py-1.5 rounded-lg text-sm font-bold hover:opacity-80 shadow-sm">
                                            ตรวจสอบ OTP
                                        </a>
                                    <?php else: ?>
                                        <span class="text-gray-400 font-medium text-sm">- ทำรายการแล้ว -</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php if (!empty($otpModal['show'])): ?>
    <div id="otpModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-lg font-bold text-gray-800">OTP ผู้เข้าร่วม</h4>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="document.getElementById('otpModal').remove()">ปิด</button>
            </div>

            <p class="text-sm text-gray-600 mb-2">
                <?= htmlspecialchars($otpModal['participant_name']) ?> (<?= htmlspecialchars($otpModal['participant_email']) ?>)
            </p>

            <div class="rounded-xl border border-blue-200 bg-blue-50 p-4">
                <p class="text-sm text-blue-800">OTP ปัจจุบัน</p>
                <p class="text-3xl font-bold tracking-widest text-blue-900">
                    <?= htmlspecialchars($otpModal['otp']) ?>
                </p>
                <p class="mt-2 text-sm text-blue-800">
                    หมดอายุใน <?= (int)$otpModal['expires_in'] ?> นาที
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php include 'footer.php'; ?>