<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">จัดการผู้เข้าร่วม: <?= htmlspecialchars($event['name']) ?></h3>
        <a href="/my-events" class="btn btn-outline-secondary">กลับหน้ารวมกิจกรรม</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">ชื่อ-นามสกุล</th>
                        <th class="py-3">อีเมล</th>
                        <th class="py-3 text-center">สถานะ</th>
                        <th class="py-3 text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($participants)): ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">ยังไม่มีผู้ขอเข้าร่วมกิจกรรมนี้</td></tr>
                    <?php else: ?>
                        <?php foreach($participants as $p): ?>
                        <tr>
                            <td class="px-4 align-middle"><?= htmlspecialchars($p['name']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($p['email']) ?></td>
                            <td class="text-center align-middle">
                                <?php 
                                    if($p['status'] == 'pending') echo '<span class="badge bg-warning text-dark"><i class="bi bi-hourglass"></i> รออนุมัติ</span>';
                                    elseif($p['status'] == 'approved') echo '<span class="badge bg-success"><i class="bi bi-check-circle"></i> อนุมัติแล้ว</span>';
                                    elseif($p['status'] == 'rejected') echo '<span class="badge bg-danger"><i class="bi bi-x-circle"></i> ปฏิเสธ</span>';
                                ?>
                            </td>
                            <td class="text-center align-middle">
                                <?php if($p['status'] == 'pending'): ?>
                                    <form action="/event-manage-action" method="POST" class="d-inline">
                                        <input type="hidden" name="eid" value="<?= $event['eid'] ?>">
                                        <input type="hidden" name="uid" value="<?= $p['uid'] ?>">
                                        
                                        <button type="submit" name="action" value="approve" class="btn btn-sm btn-success me-1">อนุมัติ</button>
                                        <button type="submit" name="action" value="reject" class="btn btn-sm btn-danger" onclick="return confirm('ต้องการปฏิเสธคนนี้ใช่ไหม?');">ปฏิเสธ</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">- ทำรายการแล้ว -</span>
                                <?php endif; ?>
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