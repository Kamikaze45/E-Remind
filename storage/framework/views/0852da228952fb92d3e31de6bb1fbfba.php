

<?php $__env->startSection('title', 'Daftar Mata Kuliah'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
<div>
  <h1><li class="fa fa-calendar"></li> Jadwal Saya</h1>
</div>

    
    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('jadwal.index') ? 'active' : ''); ?>"
               href="<?php echo e(route('jadwal.index')); ?>" role="tab">
               Jadwal
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('matkul.index') ? 'active' : ''); ?>"
               href="<?php echo e(route('matkul.index')); ?>" role="tab">
               Mata Kuliah
            </a>
        </li>
    </ul>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Mata Kuliah</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMatkul">Tambah</button>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Kode</th>
                        <th>SKS</th>
                         <th>Nama Dosen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $matkuls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i+1); ?></td>
                        <td><?php echo e($m->nama_matkul); ?></td>
                        <td><?php echo e($m->kode_matkul); ?></td>
                        <td><?php echo e($m->sks); ?></td>
                         <td><?php echo e($m->nama_dosen); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('matkul.destroy', $m->id_matkul)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus mata kuliah ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="modalTambahMatkul" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo e(route('matkul.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
          <h5 class="modal-title">Tambah Mata Kuliah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label>Nama Mata Kuliah</label>
              <input type="text" name="nama_matkul" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Kode</label>
              <input type="text" name="kode_matkul" class="form-control">
          </div>
          <div class="mb-3">
              <label>SKS</label>
              <input type="number" name="sks" class="form-control" min="1" required>
          </div>
            <div class="mb-3">
                <label>Nama Dosen</label>
                <input type="text" name="nama_dosen" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.dosenlayouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kuliah\notif-wa\resources\views/jadwal/matkul_index.blade.php ENDPATH**/ ?>