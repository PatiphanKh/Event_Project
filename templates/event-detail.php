<?php include 'header.php'; ?>

<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <h2 class="card-title text-primary fw-bold mb-3"><?= htmlspecialchars($event['name']) ?></h2>
                
                <div class="mb-4 text-muted">
                    <p class="mb-1"><i class="bi bi-calendar-event"></i> <strong>เริ่ม:</strong> <?= date('d/m/Y เวลา H:i น.', strtotime($event['start_date'])) ?></p>
                    <p class="mb-1"><i class="bi bi-calendar-event-fill"></i> <strong>สิ้นสุด:</strong> <?= date('d/m/Y เวลา H:i น.', strtotime($event['end_date'])) ?></p>
                    <p class="mb-1"><i class="bi bi-people-fill"></i> <strong>รับจำนวน:</strong> <?= number_format($event['quantity']) ?> คน</p>
                </div>
                
                <hr>
                
                <h5 class="fw-bold mt-4 mb-3">รายละเอียดกิจกรรม</h5>
                <p class="card-text" style="white-space: pre-line;">
                    <?= htmlspecialchars($event['description']) ?>
                </p>
                
                <div class="mt-5 text-center">
                    <?php if (!isset($_SESSION['uid'])): ?>
                        <a href="/login" class="btn btn-primary btn-lg px-5 me-2">เข้าสู่ระบบเพื่อเข้าร่วม</a>
                    
                    <?php elseif ($event['creator_uid'] == $_SESSION['uid']): ?>
                        <button class="btn btn-secondary btn-lg px-5 me-2" disabled>คุณเป็นผู้สร้างกิจกรรมนี้</button>

                    <?php else: ?>
                        <?php if (isset($joinStatus) && $joinStatus === 'pending'): ?>
                            <button class="btn btn-warning btn-lg px-5 me-2" disabled>
                                ⏳ รอการอนุมัติ
                            </button>
                        <?php elseif (isset($joinStatus) && $joinStatus === 'approved'): ?>
                            <button class="btn btn-success btn-lg px-5 me-2" disabled>
                                ✅ เข้าร่วมกิจกรรมแล้ว
                            </button>
                        <?php elseif (isset($joinStatus) && $joinStatus === 'rejected'): ?>
                            <button class="btn btn-danger btn-lg px-5 me-2" disabled>
                                ❌ คำขอถูกปฏิเสธ
                            </button>
                        <?php else: ?>
                            <form action="/event-join" method="POST" class="d-inline">
                                <input type="hidden" name="eid" value="<?= htmlspecialchars($event['eid']) ?>">
                                <button type="submit" class="btn btn-success btn-lg px-5 me-2" onclick="return confirm('ต้องการส่งคำขอเข้าร่วมกิจกรรมนี้ใช่หรือไม่?');">
                                    ขอเข้าร่วมกิจกรรม
                                </button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>

                    <a href="/" class="btn btn-outline-secondary btn-lg px-4">กลับหน้าหลัก</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>