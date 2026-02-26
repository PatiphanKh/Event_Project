<?php include 'header.php'; ?>

<div class="row align-items-center mt-4 mb-4">
    <div class="col-md-6">
        <h2>กิจกรรมทั้งหมด</h2>
    </div>
    <div class="col-md-6">
        <form action="/" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="ค้นหากิจกรรม..." value="<?= htmlspecialchars($searchQuery ?? '') ?>">
            <button type="submit" class="btn btn-outline-primary">ค้นหา</button>
        </form>
    </div>
</div>

<<<<<<< HEAD
    <header class="bg-[#6B8CFF] px-8 py-5 flex items-center justify-between">
        
        <div class="text-white text-3xl font-bold">
            Project WEB
=======
<div class="row">
    <?php if (empty($events)): ?>
        <div class="col-12 text-center py-5">
            <h5 class="text-muted">ยังไม่มีกิจกรรมในขณะนี้ ลองสร้างกิจกรรมแรกดูสิ!</h5>
>>>>>>> 0049ad538480f67298bc78651f4c65acbae33acc
        </div>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                    
                    <?php if (!empty($event['cover_image'])): ?>
                        <img src="<?= htmlspecialchars($event['cover_image']) ?>" class="card-img-top" alt="Cover Image" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                            <span>ไม่มีรูปภาพ</span>
                        </div>
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold" style="color: #6B8CFF;"><?= htmlspecialchars($event['name']) ?></h5>
                        <p class="card-text text-muted mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= htmlspecialchars($event['description']) ?>
                        </p>
                        
                        <div class="mt-auto">
                            <p class="mb-1"><i class="bi bi-people-fill"></i> <strong>รับจำนวน:</strong> <?= number_format($event['quantity']) ?> คน</p>
                            <p class="mb-3 text-success small">
                                <strong>เริ่ม:</strong> <?= date('d/m/Y เวลา H:i น.', strtotime($event['start_date'])) ?>
                            </p>
                            <a href="/event-detail?id=<?= $event['eid'] ?>" class="btn w-100 fw-bold" style="background-color: #00D1FF; color: black; border-radius: 8px;">
                                ดูรายละเอียด / เข้าร่วม
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>