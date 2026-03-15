<?php include 'header.php'; ?>

<div class="flex-grow flex items-center justify-center p-4 min-h-[80vh] py-10">
    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-lg w-full max-w-4xl border-2 border-[#00D1FF]">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-8">
            <h2 class="text-3xl font-bold text-[#6B8CFF]">แก้ไขกิจกรรม</h2>
            <a href="/my-events"
                class="inline-block text-center bg-gray-200 text-gray-800 px-6 py-2.5 rounded-full font-bold hover:bg-gray-300 transition shadow-sm">
                กลับหน้ารวม
            </a>
        </div>

        <?php if (!empty($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="bg-blue-50 rounded-2xl p-5 md:p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">รูปภาพกิจกรรมปัจจุบัน</h3>

            <?php if (empty($eventImages)): ?>
                <p class="text-gray-500">ยังไม่มีรูปภาพสำหรับกิจกรรมนี้</p>
            <?php else: ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <?php foreach ($eventImages as $img): ?>
                        <div class="relative group">
                            <img src="<?= htmlspecialchars($img['img_path']) ?>"
                                alt="Event Image"
                                class="w-full h-28 md:h-32 object-cover rounded-xl border border-gray-200">

                            <a href="/event-edit?id=<?= (int)$event['eid'] ?>&delete_img=<?= (int)$img['imgid'] ?>"
                                class="absolute top-2 right-2 bg-red-500 text-white text-xs px-3 py-1.5 rounded-full font-bold shadow hover:bg-red-600 transition"
                                onclick="return confirm('ต้องการลบรูปภาพนี้ใช่หรือไม่?');">
                                ลบ
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <form action="/event-edit?id=<?= (int)$event['eid'] ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
            <input type="hidden" name="id" value="<?= (int)$event['eid'] ?>">

            <div>
                <label class="block text-gray-700 font-bold mb-2">ชื่องานกิจกรรม</label>
                <input type="text" name="name" required
                    value="<?= htmlspecialchars($event['name']) ?>"
                    class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">รายละเอียด</label>
                <textarea name="description" rows="4" required
                    class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition resize-none"><?= htmlspecialchars($event['description']) ?></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">เพิ่มรูปภาพใหม่ (เลือกได้หลายรูป)</label>
                <input type="file" name="images[]" accept="image/*" multiple
                    class="w-full bg-[#E6E6E6] text-gray-500 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#00D1FF] file:text-black hover:file:bg-opacity-80">
                <p class="text-xs text-gray-500 mt-2">* หากไม่ต้องการเพิ่มรูปใหม่ ให้เว้นว่างไว้</p>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">จำนวนที่รับสมัคร (คน)</label>
                <input type="number" name="quantity" min="1" required
                    value="<?= htmlspecialchars($event['quantity']) ?>"
                    class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
            </div>

            <div class="flex flex-col md:flex-row gap-5">
                <div class="w-full md:w-1/2">
                    <label class="block text-green-600 font-bold mb-2">วัน-เวลา เริ่มต้น</label>
                    <input type="datetime-local" name="start_date" required
                        value="<?= date('Y-m-d\TH:i', strtotime($event['start_date'])) ?>"
                        class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>

                <div class="w-full md:w-1/2">
                    <label class="block text-red-600 font-bold mb-2">วัน-เวลา สิ้นสุด</label>
                    <input type="datetime-local" name="end_date" required
                        value="<?= date('Y-m-d\TH:i', strtotime($event['end_date'])) ?>"
                        class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-[#00FF00] text-black text-lg px-8 py-3 rounded-full font-bold hover:opacity-80 transition shadow-md">
                    บันทึกการเปลี่ยนแปลง
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.querySelector('input[name="start_date"]');
        const endDateInput = document.querySelector('input[name="end_date"]');

        startDateInput.addEventListener('change', function() {
            // บังคับให้ช่อง "วันสิ้นสุด" เลือกวันที่ย้อนหลังก่อน "วันเริ่มต้น" ไม่ได้
            endDateInput.min = this.value;

            // ถ้าผู้ใช้เคยเลือกวันสิ้นสุดไว้ก่อนแล้ว แต่มันดันน้อยกว่าวันเริ่มต้นที่เพิ่งแก้ ให้เปลี่ยนค่าให้เท่ากัน
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = this.value;
            }
        });
    });
</script>

<?php include 'footer.php'; ?>