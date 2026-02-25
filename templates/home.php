<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['title']) ? $data['title'] : 'หน้าแรก' ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <header class="bg-[#6B8CFF] px-8 py-5 flex items-center justify-between">
        
        <div class="text-white text-3xl">
            LOGO ต้องใส่ไหมหว่า?
        </div>

        <div class="flex items-center bg-gray-200 rounded-full px-4 py-2 w-full max-w-xl mx-4">
            
            <input 
                type="text" 
                placeholder="ค้นหากิจกรรม" 
                class="bg-transparent outline-none flex-grow"
            >
            
            <div class="flex gap-2">
                <span class="cursor-pointer">📅</span> <span class="cursor-pointer">🔍</span> </div>
        </div>

        <div class="flex gap-4">
            
            <a href="/register" class="bg-[#34F874] text-black px-6 py-2 rounded-md hover:opacity-80">
                สมัครสมาชิก
            </a>
            
            <a href="/login" class="bg-[#00D1FF] text-black px-6 py-2 rounded-md hover:opacity-80">
                เข้าสู่ระบบ
            </a>

        </div>

    </header>

</body>
</html>


