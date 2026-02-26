<?php include 'header.php'; ?>

<div class="flex-grow flex items-center justify-center p-4 min-h-[80vh] py-10">
    
    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-lg w-full max-w-3xl border-2 border-[#00D1FF]">
        
        <h2 class="text-3xl font-bold text-center mb-8">สร้างกิจกรรมใหม่</h2>
        
        <?php if(!empty($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6 text-center text-sm font-medium">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6 text-center text-sm font-medium">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/event-create" method="POST" enctype="multipart/form-data" class="space-y-5">
            
            <div>
                <label class="block text-gray-700 font-bold mb-2">ชื่องานกิจกรรม</label>
                <input type="text" name="name" placeholder="เช่น ค่ายอาสาพัฒนาโรงเรียน" required
                       class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">รายละเอียด</label>
                <textarea name="description" rows="4" placeholder="อธิบายเกี่ยวกับกิจกรรมของคุณ..." required
                          class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition resize-none"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">รูปภาพกิจกรรม (เลือกได้หลายรูป)</label>
                <input type="file" name="images[]" accept="image/*" multiple required
                       class="w-full bg-[#E6E6E6] text-gray-500 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#00D1FF] file:text-black hover:file:bg-opacity-80">
                <p class="text-xs text-gray-500 mt-2">* กดปุ่ม Ctrl (หรือ Cmd บน Mac) ค้างไว้ตอนเลือกรูป เพื่ออัปโหลดทีละหลายรูป</p>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">จำนวนที่รับสมัคร (คน)</label>
                <input type="number" name="quantity" min="1" placeholder="ระบุจำนวนคน" required
                       class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
            </div>

            <div class="flex flex-col md:flex-row gap-5">
                <div class="w-full md:w-1/2">
                    <label class="block text-green-600 font-bold mb-2">วัน-เวลา เริ่มต้น</label>
                    <input type="datetime-local" name="start_date" required
                           class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block text-red-600 font-bold mb-2">วัน-เวลา สิ้นสุด</label>
                    <input type="datetime-local" name="end_date" required
                           class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#00FF00] text-black text-lg px-8 py-3 rounded-full font-bold hover:opacity-80 transition shadow-md">
                    บันทึกกิจกรรม
                </button>
            </div>

        </form>

    </div>

</div>

<?php include 'footer.php'; ?>