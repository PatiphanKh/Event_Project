<?php include 'header.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-center my-8 gap-4">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">กิจกรรมทั้งหมด</h2>
    
    <form action="/" method="GET" class="flex w-full md:w-1/2 lg:w-1/3 gap-2">
        <input type="text" name="search" placeholder="ค้นหากิจกรรม..." 
               value="<?= htmlspecialchars($searchQuery ?? '') ?>"
               class="w-full bg-[#E6E6E6] text-gray-800 px-4 py-2 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
        <button type="submit" 
                class="bg-[#00D1FF] text-black px-6 py-2 rounded-xl font-bold hover:opacity-80 transition shadow-sm whitespace-nowrap">
            ค้นหา
        </button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    
    <?php if (empty($events)): ?>
        <div class="col-span-full text-center py-16 bg-white rounded-3xl shadow-sm border border-dashed border-gray-300">
            <h5 class="text-xl text-gray-500 font-medium mb-2">ยังไม่มีกิจกรรมในขณะนี้ </h5>
            <p class="text-gray-400">ลองสร้างกิจกรรมแรกดูสิ!</p>
        </div>
    <?php else: ?>
        
        <?php foreach ($events as $event): ?>
            <div class="bg-white rounded-3xl shadow-md overflow-hidden flex flex-col hover:shadow-lg transition duration-300 border-2 border-transparent hover:border-[#00D1FF]">
                
                <?php if (!empty($event['cover_image'])): ?>
                    <img src="<?= htmlspecialchars($event['cover_image']) ?>" alt="Cover Image" 
                         class="w-full h-48 object-cover">
                <?php else: ?>
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 font-medium">
                        <span>ไม่มีรูปภาพ 📷</span>
                    </div>
                <?php endif; ?>

                <div class="p-6 flex flex-col flex-grow">
                    <h5 class="text-xl font-bold text-[#6B8CFF] mb-2 line-clamp-1" title="<?= htmlspecialchars($event['name']) ?>">
                        <?= htmlspecialchars($event['name']) ?>
                    </h5>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        <?= htmlspecialchars($event['description']) ?>
                    </p>
                    
                    <div class="mt-auto space-y-2 mb-5">
                        <p class="text-sm text-gray-700 flex items-center gap-2">
                            <span class="text-lg">👥</span> 
                            <strong>รับสมัคร:</strong> <?= number_format($event['quantity']) ?> คน
                        </p>
                        <p class="text-sm text-green-600 flex items-center gap-2">
                            <span class="text-lg">📅</span> 
                            <strong>เริ่ม:</strong> <?= date('d/m/Y H:i น.', strtotime($event['start_date'])) ?>
                        </p>
                    </div>

                    <a href="/event-detail?id=<?= $event['eid'] ?>" 
                       class="block text-center w-full bg-[#00D1FF] text-black px-4 py-2.5 rounded-xl font-bold hover:opacity-80 transition shadow-sm mt-auto">
                        ดูรายละเอียด / เข้าร่วม
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        
    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>