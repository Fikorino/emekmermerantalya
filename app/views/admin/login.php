<?php
ob_start();
?>
<div class="container py-5" style="max-width: 420px;">
    <h1 class="mb-4">Admin Giriş</h1>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= Security::e($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= Security::e($csrf ?? '') ?>">
        <div class="mb-3">
            <label class="form-label">E-posta</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Giriş</button>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/admin.php';
?>
