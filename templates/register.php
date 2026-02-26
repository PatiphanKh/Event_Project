<?php include 'header.php'; ?>

<div class="flex-grow flex items-center justify-center p-4 min-h-[80vh]">
    
    <div class="bg-white p-10 rounded-3xl shadow-lg w-full max-w-md border-2 border-[#00D1FF]">
        
        <h2 class="text-3xl font-bold text-center mb-8">Register</h2>

        <?php if(!empty($data['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6 text-center text-sm font-medium">
                <?= htmlspecialchars($data['error']) ?>
            </div>
        <?php endif; ?>

        <form action="/register" method="POST" class="space-y-4">
            
            <div>
                <input type="text" name="name" placeholder="ชื่อ-นามสกุล" required
                       class="w-full bg-[#E6E6E6] text-gray-800 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <div class="relative w-full sm:w-1/2">
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

                <div class="w-full sm:w-1/2">
                    <input type="date" name="birth_date" required
                           class="w-full bg-[#E6E6E6] text-gray-500 px-5 py-3 rounded-xl outline-none focus:ring-2 focus:ring-[#00D1FF] transition">
                </div>
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
                <button type="reset" class="bg-[#FF0000] text-white px-8 py-2 rounded-full font-bold hover:opacity-80 transition shadow-md w-1/2">
                    ยกเลิก
                </button>
                <button type="submit" class="bg-[#00FF00] text-black px-8 py-2 rounded-full font-bold hover:opacity-80 transition shadow-md w-1/2">
                    ยืนยัน
                </button>
            </div>

        </form>

        <div class="text-center mt-6 text-xs text-gray-800 font-semibold">
            มีบัญชีอยู่แล้ว? <a href="/login" class="text-blue-500 hover:underline">เข้าสู่ระบบที่นี่</a>
        </div>

    </div>

</div>

<?php include 'footer.php'; ?>
>>>>>>> 0049ad538480f67298bc78651f4c65acbae33acc
