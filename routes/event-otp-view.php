<?php

require_once __DIR__ . '/../database/mailer_otp.php';

if (!isset($_SESSION['uid'])) {
    header('Location: /login');
    exit;
}

$eid = isset($_GET['eid']) ? (int) $_GET['eid'] : 0;
$targetUid = isset($_GET['uid']) ? (int) $_GET['uid'] : 0;

$event = getEventById($eid);
if (!$event || (int) $event['creator_uid'] !== (int) $_SESSION['uid']) {
    die('คุณไม่มีสิทธิ์ตรวจสอบ OTP ของกิจกรรมนี้');
}

$status = checkJoinStatus($eid, $targetUid);
if ($status !== 'approved') {
    die('ผู้ใช้นี้ยังไม่ได้รับการอนุมัติ');
}

$targetUser = getUserById($targetUid);
if (!$targetUser) {
    die('ไม่พบผู้ใช้');
}

$otpData = otpGetCurrentAndPrevious($targetUser['email'], $eid);

$participants = getEventParticipants($eid);

$expiresInMinutes = (int) ceil($otpData['expires_in'] / 60);
// ส่งกลับไป render หน้า event-manage พร้อมข้อมูล popup
renderView('event-manage', [
    'event' => $event,
    'participants' => $participants,
    'otpModal' => [
        'show' => true,
        'participant_name' => $targetUser['name'],
        'participant_email' => $targetUser['email'],
        'otp' => $otpData['current'],
        'expires_in' => $expiresInMinutes,
    ],
]);