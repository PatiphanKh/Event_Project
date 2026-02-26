<?php

// ---------------------------------------------------------
// 1. ฟังก์ชันสำหรับดึงข้อมูลกิจกรรมทั้งหมด (อัปเดต: ดึงรูปลงมาด้วยจาก event_imgs)
// ---------------------------------------------------------
function getAllEvents($searchQuery = '')
{
    $conn = getConnection();
    
    // เปลี่ยนชื่อตารางเป็น event_imgs และคอลัมน์เป็น img_path ให้ตรงกับของคุณ
    $sql = "SELECT e.*, 
            (SELECT img_path FROM event_imgs ei WHERE ei.eid = e.eid LIMIT 1) AS cover_image 
            FROM events e ";

    if ($searchQuery !== '') {
        $sql .= "WHERE e.name LIKE ? ORDER BY e.start_date ASC";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $searchQuery . "%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql .= "ORDER BY e.start_date ASC";
        $result = $conn->query($sql);
    }

    $events = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    
    return $events;
}

// ---------------------------------------------------------
// ฟังก์ชันใหม่: สำหรับบันทึกเส้นทางรูปภาพลง Database (ตาราง event_imgs)
// ---------------------------------------------------------
function addEventImage($eid, $imagePath)
{
    $conn = getConnection();
    // เปลี่ยนชื่อตารางและคอลัมน์ให้ตรงเป๊ะๆ
    $stmt = $conn->prepare("INSERT INTO event_imgs (eid, img_path) VALUES (?, ?)");
    $stmt->bind_param("is", $eid, $imagePath);
    return $stmt->execute();
}

// ---------------------------------------------------------
// 2. [เพิ่มใหม่] ฟังก์ชันสำหรับสร้างกิจกรรมใหม่ลง Database
// ---------------------------------------------------------
function createEvent($uid, $name, $description, $quantity, $start_date, $end_date)
{
    $conn = getConnection();
    
    // 💡 แก้ตรง INSERT ให้เป็น creator_uid ด้วยเหมือนกัน
    $stmt = $conn->prepare("INSERT INTO events (creator_uid, name, description, quantity, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississ", $uid, $name, $description, $quantity, $start_date, $end_date);
    
    if ($stmt->execute()) {
        return $conn->insert_id; 
    }
    return false;
}

function getMyEvents($uid)
{
    $conn = getConnection();
    
    // 💡 แก้ตรง WHERE ให้เป็น creator_uid
    $stmt = $conn->prepare("SELECT * FROM events WHERE creator_uid = ? ORDER BY start_date DESC");
    
    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    $events = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    
    return $events;
}

// ฟังก์ชันสำหรับลบกิจกรรม
function deleteEvent($eid, $uid)
{
    $conn = getConnection();
    
    // ลบโดยเช็คว่า eid ตรงกัน และคนลบต้องเป็นคนสร้าง (creator_uid) เท่านั้น
    $stmt = $conn->prepare("DELETE FROM events WHERE eid = ? AND creator_uid = ?");
    
    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ii", $eid, $uid);
    
    return $stmt->execute();
}

// ฟังก์ชันสำหรับดึงข้อมูลกิจกรรมแค่ 1 อัน ตาม ID
function getEventById($eid)
{
    $conn = getConnection();
    
    $stmt = $conn->prepare("SELECT * FROM events WHERE eid = ? LIMIT 1");
    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return false; // หาไม่เจอ
}

// ฟังก์ชันเช็กว่า user คนนี้เคยส่งคำขอเข้าร่วมกิจกรรมนี้หรือยัง
function checkJoinStatus($eid, $uid)
{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT status FROM event_joins WHERE eid = ? AND uid = ? LIMIT 1");
    $stmt->bind_param("ii", $eid, $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['status']; // จะคืนค่า 'pending', 'approved', 'rejected'
    }
    return false; // ยังไม่เคยขอเข้าร่วม
}

// ฟังก์ชันสำหรับส่งคำขอเข้าร่วมกิจกรรม
function requestToJoinEvent($eid, $uid)
{
    $conn = getConnection();
    // เพิ่มข้อมูลลงไป โดยตั้งสถานะเป็น 'pending' (รออนุมัติ)
    $stmt = $conn->prepare("INSERT INTO event_joins (eid, uid, status) VALUES (?, ?, 'pending')");
    $stmt->bind_param("ii", $eid, $uid);
    return $stmt->execute();
}

// 1. ฟังก์ชันดึงรายชื่อคนที่มาขอเข้าร่วม (ใช้ JOIN เพื่อเอาชื่อกับอีเมลจากตาราง users มาแสดงด้วย)
function getEventParticipants($eid)
{
    $conn = getConnection();
    $stmt = $conn->prepare("
        SELECT ej.*, u.name, u.email 
        FROM event_joins ej
        JOIN users u ON ej.uid = u.uid
        WHERE ej.eid = ?
    ");
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// 2. ฟังก์ชันสำหรับเปลี่ยนสถานะ (อนุมัติ / ปฏิเสธ)
function updateJoinStatus($eid, $uid, $status)
{
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE event_joins SET status = ? WHERE eid = ? AND uid = ?");
    $stmt->bind_param("sii", $status, $eid, $uid);
    return $stmt->execute();
}

// ฟังก์ชันดึงรายการกิจกรรมที่ user คนนี้เข้าร่วม (หรือส่งคำขอไว้)
function getJoinedEvents($uid)
{
    $conn = getConnection();
    // ดึงข้อมูลกิจกรรม (e) และสถานะการเข้าร่วม (ej) มาเชื่อมกัน
    $stmt = $conn->prepare("
        SELECT e.*, ej.status AS join_status 
        FROM events e
        JOIN event_joins ej ON e.eid = ej.eid
        WHERE ej.uid = ?
        ORDER BY e.start_date DESC
    ");
    
    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// ---------------------------------------------------------
// ฟังก์ชันสำหรับอัปเดตข้อมูลกิจกรรม
// ---------------------------------------------------------
function updateEvent($eid, $uid, $name, $description, $quantity, $start_date, $end_date)
{
    $conn = getConnection();
    
    // อัปเดตข้อมูลโดยเช็กเงื่อนไขว่า eid ตรง และ creator_uid ตรงกับคนที่ล็อกอิน
    $stmt = $conn->prepare("UPDATE events SET name = ?, description = ?, quantity = ?, start_date = ?, end_date = ? WHERE eid = ? AND creator_uid = ?");
    $stmt->bind_param("ssissii", $name, $description, $quantity, $start_date, $end_date, $eid, $uid);
    
    return $stmt->execute();
}

// ---------------------------------------------------------
// ดึงรูปภาพทั้งหมดของกิจกรรม
// ---------------------------------------------------------
function getEventImages($eid)
{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM event_imgs WHERE eid = ?");
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// ---------------------------------------------------------
// ลบรูปภาพ 1 รูป (ลบจากฐานข้อมูล และลบไฟล์ในโฟลเดอร์)
// ---------------------------------------------------------
function deleteEventImage($imgid, $eid)
{
    $conn = getConnection();
    
    // 1. ดึง path รูปมาเช็กก่อนเพื่อลบไฟล์ออกจากโฟลเดอร์
    $stmt = $conn->prepare("SELECT img_path FROM event_imgs WHERE imgid = ? AND eid = ?");
    $stmt->bind_param("ii", $imgid, $eid);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        // พาธไฟล์จริงบนเซิร์ฟเวอร์ (ลบเครื่องหมาย / ตัวแรกออกเพื่อให้อ้างอิงโฟลเดอร์ถูก)
        $filePath = ltrim($row['img_path'], '/'); 
        
        if (file_exists($filePath)) {
            unlink($filePath); // สั่งลบไฟล์ออกจากโฟลเดอร์ uploads/
        }
        
        // 2. ลบข้อมูลออกจากฐานข้อมูล
        $delStmt = $conn->prepare("DELETE FROM event_imgs WHERE imgid = ? AND eid = ?");
        $delStmt->bind_param("ii", $imgid, $eid);
        return $delStmt->execute();
    }
    return false;
}