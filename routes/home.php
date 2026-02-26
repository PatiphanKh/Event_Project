<?php

// รับค่าคำค้นหา (ถ้ามีการพิมพ์ค้นหา)
$searchQuery = $_GET['search'] ?? '';

// เรียกใช้ฟังก์ชัน getAllEvents (ที่เรามีอยู่แล้วใน event_model.php)
$events = getAllEvents($searchQuery);

// ส่งข้อมูลที่ดึงมาได้ ไปแสดงผลที่หน้า template 
renderView('home', [
    'events' => $events,
    'searchQuery' => $searchQuery
]);