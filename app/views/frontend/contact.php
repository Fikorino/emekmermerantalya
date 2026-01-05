<?php
ob_start();
?>
<section class="container py-5">
    <h1 class="section-title">İletişim</h1>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= Security::e($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= Security::e($success) ?></div>
    <?php endif; ?>
    <form method="post" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= Security::e($csrf ?? '') ?>">
        <div class="col-md-6">
            <label class="form-label">Ad Soyad</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Telefon</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">E-posta</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="col-md-12">
            <label class="form-label">Mesaj</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Gönder</button>
        </div>
    </form>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
