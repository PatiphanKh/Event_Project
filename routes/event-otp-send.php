<?php

require_once __DIR__ . '/../database/mailer_otp.php';

if (!isset($_SESSION['uid'])) {
    header('Location: /login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$eid = isset($_POST['eid']) ? (int) $_POST['eid'] : 0;
$uid = (int) $_SESSION['uid'];

$event = getEventById($eid);
if (!$event) {
    die('ไม่พบกิจกรรม');
}

$status = checkJoinStatus($eid, $uid);
if ($status !== 'approved') {
    die('คุณยังไม่ได้รับการอนุมัติเข้าร่วมกิจกรรมนี้');
}

$user = getUserById($uid);
if (!$user) {
    die('ไม่พบข้อมูลผู้ใช้');
}

$otpData = otpGetCurrentAndPrevious($user['email'], $eid);
$isSent = sendParticipantOtpEmail(
    $user['email'],
    $user['name'],
    $event['name'],
    $otpData['current'],
    $otpData['expires_in']
);

$msg = $isSent ? 'ส่ง OTP ไปยังอีเมลแล้ว' : 'ส่ง OTP ไม่สำเร็จ';
header('Location: /event-detail?id=' . $eid . '&msg=' . urlencode($msg));
exit;