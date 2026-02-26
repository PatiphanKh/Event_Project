<?php include 'header.php'; ?>

<div class="row justify-content-center mt-4 mb-5">
    <div class="col-md-8">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">แก้ไขกิจกรรม</h2>
            <a href="/my-events" class="btn btn-outline-secondary">กลับหน้ารวม</a>
        </div>
        
        <?php if(!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">รูปภาพกิจกรรมปัจจุบัน</div>
            <div class="card-body">
                <?php if (empty($eventImages)): ?>
                    <p class="text-muted mb-0">ยังไม่มีรูปภาพสำหรับกิจกรรมนี้</p>
                <?php else: ?>
                    <div class="row g-3">
                        <?php foreach ($eventImages as $img): ?>
                            <div class="col-6 col-md-4 col-lg-3 position-relative">
                                <img src="<?= htmlspecialchars($img['img_path']) ?>" class="img-fluid rounded border" alt="Event Image" style="height: 120px; width: 100%; object-fit: cover;">
                                
                                <a href="/event-edit?id=<?= $event['eid'] ?>&delete_img=<?= $img['imgid'] ?>" 
                                   class="btn btn-danger btn-sm position-absolute" 
                                   style="top: 5px; right: 10px; border-radius: 50%;"
                                   onclick="return confirm('ต้องการลบรูปภาพนี้ใช่หรือไม่?');">
                                    <i class="bi bi-x-lg"></i> ลบ
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="/event-edit?id=<?= $event['eid'] ?>" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" value="<?= $event['eid'] ?>">

                    <div class="mb-3">
                        <label class="form-label fw-bold">ชื่องานกิจกรรม</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($event['name']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">รายละเอียด</label>
                        <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($event['description']) ?></textarea>
                    </div>

                    <div class="mb-3 p-3 border rounded bg-light">
                        <label class="form-label fw-bold text-primary">เพิ่มรูปภาพใหม่ (เลือกได้หลายรูป)</label>
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">* หากไม่ต้องการเพิ่มรูปใหม่ ให้เว้นว่างไว้</small>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">จำนวนที่รับสมัคร (คน)</label>
                        <input type="number" name="quantity" class="form-control" min="1" value="<?= htmlspecialchars($event['quantity']) ?>" required>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-bold text-success">วัน-เวลา เริ่มต้น</label>
                            <input type="datetime-local" name="start_date" class="form-control" 
                                   value="<?= date('Y-m-d\TH:i', strtotime($event['start_date'])) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-danger">วัน-เวลา สิ้นสุด</label>
                            <input type="datetime-local" name="end_date" class="form-control" 
                                   value="<?= date('Y-m-d\TH:i', strtotime($event['end_date'])) ?>" required>
                        </div>
                    </div>
                    
                    <hr>
                    <button type="submit" class="btn btn-warning btn-lg w-100 mt-2 fw-bold">บันทึกการเปลี่ยนแปลง</button>
                    
                </form>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>