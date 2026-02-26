<?php include 'header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-4">
    <h2>กิจกรรมของฉัน</h2>
    <a href="/event-create" class="btn btn-success">+ สร้างกิจกรรมใหม่</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="p-3">ชื่องาน</th>
                        <th class="p-3">วันที่เริ่ม</th>
                        <th class="p-3">รับสมัคร (คน)</th>
                        <th class="p-3 text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($events)): ?>
                        <tr>
                            <td colspan="4" class="text-center p-4 text-muted">
                                ยังไม่มีกิจกรรมที่คุณสร้างครับ <br>
                                <a href="/event-create" class="btn btn-sm btn-outline-primary mt-2">สร้างกิจกรรมแรกเลย!</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td class="p-3 fw-bold"><?= htmlspecialchars($event['name']) ?></td>
                                <td class="p-3"><?= date('d/m/Y H:i', strtotime($event['start_date'])) ?></td>
                                <td class="p-3"><?= number_format($event['quantity']) ?></td>
                                <td class="p-3 text-center">
                                    <a href="/event-detail?id=<?= $event['eid'] ?>" class="btn btn-sm btn-info text-white">ดู</a>
                                    <a href="/event-edit?id=<?= $event['eid'] ?>" class="btn btn-sm btn-warning text-dark">แก้ไข</a>
                                    <a href="/event-delete?id=<?= $event['eid'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('แน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?');">ลบ</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>