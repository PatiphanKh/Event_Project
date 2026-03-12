<?php

declare(strict_types=1);

// ==========================================
// PHPMailer
// ==========================================
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

function createMailer(): PHPMailer
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'patiphan.kh2186@gmail.com';
    $mail->Password   = 'zqbe iyqt bfld pgvo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->setFrom('patiphan.kh2186@gmail.com', 'Admin Patiphan');
    return $mail;
}

function sendParticipantOtpEmail(string $toEmail, string $toName, string $eventName, string $otp, int $expiresIn): bool
{
    try {
        $expiresInMinutes = (int) ceil($expiresIn / 60);
        $mail = createMailer();
        $mail->addAddress($toEmail, $toName);
        $mail->isHTML(true);
        $mail->Subject = "OTP สำหรับกิจกรรม: {$eventName}";
        $mail->Body    = "
            <h3>รหัส OTP ของคุณ</h3>
            <p>กิจกรรม: <b>" . htmlspecialchars($eventName, ENT_QUOTES, 'UTF-8') . "</b></p>
            <p style='font-size:28px;letter-spacing:2px'><b>{$otp}</b></p>
            <p>รหัสจะหมดอายุในประมาณ {$expiresInMinutes} นาที</p>
        ";
        $mail->AltBody = "OTP: {$otp}, หมดอายุใน {$expiresInMinutes} นาที";
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('OTP mail error: ' . $e->getMessage());
        return false;
    }
}

// ==========================================
// OTP (Stateless TOTP)
// ==========================================
const OTP_DIGITS         = 6;
const OTP_WINDOW_SECONDS = 1800;
const OTP_SECRET         = 'PATIPHAN_KHIAWSAART_RANDOM_ONE_TIME_PASSWORD_2026';

function otpCurrentStep(): int
{
    return (int) floor(time() / OTP_WINDOW_SECONDS);
}

function otpGenerate(string $email, int $eid, int $step): string
{
    $payload = strtolower(trim($email)) . '|' . $eid . '|' . $step;
    $hmac = hash_hmac('sha256', $payload, OTP_SECRET);
    $num  = hexdec(substr($hmac, 0, 8)) % (10 ** OTP_DIGITS);
    return str_pad((string) $num, OTP_DIGITS, '0', STR_PAD_LEFT);
}

function otpGetCurrentAndPrevious(string $email, int $eid): array
{
    $step = otpCurrentStep();
    return [
        'current'    => otpGenerate($email, $eid, $step),
        'previous'   => otpGenerate($email, $eid, $step - 1),
        'expires_in' => OTP_WINDOW_SECONDS - (time() % OTP_WINDOW_SECONDS),
    ];
}