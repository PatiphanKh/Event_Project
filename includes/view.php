<?php

declare(strict_types=1);

// ฟังก์ชันสำหรับแสดงมุมมอง (view) โดยรับชื่อเทมเพลตและข้อมูลที่ต้องการส่งไปยังเทมเพลต
function renderView(string $template, array $data = []): void
{
    // แปลง Key ของ Array ให้กลายเป็นตัวแปร เพื่อให้เรียกใช้ในหน้า Template ได้ง่ายขึ้น
    extract($data);
    
    // ดึงไฟล์ HTML/PHP จากโฟลเดอร์ templates มาแสดงผล
    include TEMPLATES_DIR . '/' . $template . '.php';
}