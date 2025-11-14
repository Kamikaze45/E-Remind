

<?php $__env->startSection('title', 'Jadwal Saya'); ?>

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
        <h2>Daftar Jadwal</h2>
        <div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">Tambah Jadwal</button>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Mata Kuliah</th>
                            <th>Ruang</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($i + 1); ?></td>
                            <td><?php echo e(ucfirst($jadwal->hari)); ?></td>
                           <td><?php echo e(\Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')); ?></td>
                            <td><?php echo e($jadwal->mataKuliah->nama_matkul ?? '-'); ?></td>
                            <td><?php echo e($jadwal->ruang->nama_ruang ?? '-'); ?></td>
                            <td><?php echo e($jadwal->kelas); ?></td>
                            <td>
                                <form action="<?php echo e(route('jadwal.destroy', $jadwal->id_jadwal)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="text-center">Belum ada jadwal.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo e(route('jadwal.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
          <h5 class="modal-title">Tambah Jadwal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label>Mata Kuliah</label>
              <select name="matkul" class="form-select" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                <?php $__currentLoopData = $matkuls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($m->id_matkul); ?>"><?php echo e($m->nama_matkul); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>
          <div class="mb-3">
              <label>Hari</label>
              <select name="hari" class="form-select" required>
                  <?php $__currentLoopData = ['senin','selasa','rabu','kamis','jumat','sabtu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($hari); ?>"><?php echo e(ucfirst($hari)); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>
          <div class="row">
              <div class="col-md-6 mb-3">
                  <label>Jam Mulai</label>
                  <input type="time" name="jam_mulai" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                  <label>Jam Selesai</label>
                  <input type="time" name="jam_selesai" class="form-control" required>
              </div>
          </div>
          <div class="mb-3">
              <label>Ruang</label>
              <select name="id_ruang" class="form-select">
                <option value="">-- Pilih Ruang --</option>
                <?php $__currentLoopData = $ruangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($r->id_ruang); ?>"><?php echo e($r->nama_ruang); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>
          <div class="mb-3">
              <label>Kelas</label>
              <input type="text" name="kelas" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan Jadwal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.nav-tabs .nav-link {
    color: #0d6efd;
    font-weight: 500;
}
.nav-tabs .nav-link.active {
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
    font-weight: 600;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.dosenlayouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kuliah\notif-wa\resources\views/jadwal/jadwal_saya.blade.php ENDPATH**/ ?>