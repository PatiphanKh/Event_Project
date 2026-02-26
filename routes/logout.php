<?php

// ล้างข้อมูล Session ทั้งหมด (ลบการจำค่าว่าใครล็อกอินอยู่)
session_unset();
session_destroy();

// สั่งให้เด้งกลับไปที่หน้าแรก (หรือถ้าอยากให้เด้งไปหน้า login ก็เปลี่ยนเป็น /login ได้ครับ)
header('Location: /');
exit;