<?php include 'header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary"><i class="bi bi-bookmark-star-fill"></i> กิจกรรมที่ฉันเข้าร่วม</h2>
        <a href="/" class="btn btn-outline-primary">หาดูกิจกรรมเพิ่มเติม</a>
    </div>

    <?php if (empty($events)): ?>
        <div class="alert alert-light text-center py-5 shadow-sm">
            <h4 class="text-muted mb-3">คุณยังไม่ได้เข้าร่วมกิจกรรมใดๆ เลย</h4>
            <a href="/" class="btn btn-primary">ไปดูกิจกรรมที่น่าสนใจกันเถอะ!</a>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($events as $event): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="mb-2">
                                <?php if ($event['join_status'] == 'pending'): ?>
                                    <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> รอการอนุมัติ</span>
                                <?php elseif ($event['join_status'] == 'approved'): ?>
                                    <span class="badge bg-success"><i class="bi bi-check-circle-fill"></i> เข้าร่วมแล้ว</span>
                                <?php elseif ($event['join_status'] == 'rejected'): ?>
                                    <span class="badge bg-danger"><i class="bi bi-x-circle-fill"></i> ถูกปฏิเสธ</span>
                                <?php endif; ?>
                            </div>

                            <h5 class="card-title fw-bold text-truncate" title="<?= htmlspecialchars($event['name']) ?>">
                                <?= htmlspecialchars($event['name']) ?>
                            </h5>
                            
                            <p class="card-text text-muted small mb-3">
                                <i class="bi bi-calendar-event"></i> <?= date('d/m/Y', strtotime($event['start_date'])) ?> 
                                ถึง <?= date('d/m/Y', strtotime($event['end_date'])) ?>
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top-0 pb-3">
                            <a href="/event-detail?id=<?= $event['eid'] ?>" class="btn btn-outline-primary w-100">ดูรายละเอียด</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>