

<?php $__env->startSection('title', 'Detail Profil'); ?>

<?php $__env->startSection('content'); ?>

<div class="container py-5">
    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Profil Saya</h4>
        </div>

        <div class="card-body">
            
            <div class="mb-4 text-center">
                <label class="form-label d-block">Foto Profil</label>
                <?php if($profile && $profile->foto_profil): ?>
                    <img src="<?php echo e(asset('storage/' . $profile->foto_profil)); ?>"
                         alt="Foto Profil"
                         class="rounded-circle"
                         width="150" height="150">
                <?php else: ?>
                      <span class="mr-2"><i class="fa fa-user-circle fa-2x text-secondary"></i></span>
                <?php endif; ?>
            </div>

            <hr>

            
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" rows="3" readonly><?php echo e($profile->alamat ?? '-'); ?></textarea>
            </div>

            
            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control"
                       value="<?php echo e($profile->nomor_telepon ?? '-'); ?>" readonly>
            </div>

            
            <div class="mb-3">
    <label class="form-label">Tanggal Lahir</label>
    <input type="text" class="form-control"
           value="<?php echo e($profile->tanggal_lahir ? $profile->tanggal_lahir->format('d-m-Y') : '-'); ?>"
           readonly>
</div>


            
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-control" disabled>
                    <option value="">-- Pilih --</option>
                    <option value="L" <?php echo e(($profile->jenis_kelamin ?? '') == 'L' ? 'selected' : ''); ?>>Laki-laki</option>
                    <option value="P" <?php echo e(($profile->jenis_kelamin ?? '') == 'P' ? 'selected' : ''); ?>>Perempuan</option>
                </select>
            </div>

            
            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea class="form-control" rows="3" readonly><?php echo e($profile->bio ?? '-'); ?></textarea>
            </div>

            
            <div class="mb-3">
                <label class="form-label">Media Sosial</label>
                <input type="text" class="form-control"
                       value="<?php echo e($profile->media_sosial ?? '-'); ?>" readonly>
            </div>

            
            <div class="text-end">
    <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-success px-4">
        <i class="fa fa-edit me-2"></i> Edit
    </a>
</div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adminlayouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kuliah\notif-wa\resources\views/admin/adminprofile/view.blade.php ENDPATH**/ ?>