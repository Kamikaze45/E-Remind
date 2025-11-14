


<?php $__env->startSection('title', 'Schedule Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <h2 class="mb-3"><li class="fa fa-calendar"></li> Schedule Management</h2>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <form class="mb-3 row g-2" method="get" action="<?php echo e(route('schedule.index')); ?>">
        <div class="col-auto">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="Search (matkul / dosen / ruang / gedung)">
        </div>
        <div class="col-auto">
            <select name="per" class="form-select">
                <option value="8" <?php echo e(request('per')==8?'selected':''); ?>>8 / page</option>
                <option value="12" <?php echo e(request('per')==12?'selected':''); ?>>12 / page</option>
                <option value="25" <?php echo e(request('per')==25?'selected':''); ?>>25 / page</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    
    <ul class="nav nav-tabs mb-3" id="scheduleTabs" role="tablist">
        <?php $active = $tab ?? 'jadwal'; ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e($active=='jadwal' ? 'active' : ''); ?>" href="<?php echo e(route('schedule.index', array_merge(request()->except('page'), ['tab'=>'jadwal']))); ?>">Jadwal</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e($active=='matkul' ? 'active' : ''); ?>" href="<?php echo e(route('schedule.index', array_merge(request()->except('page'), ['tab'=>'matkul']))); ?>">Mata Kuliah</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e($active=='gedung' ? 'active' : ''); ?>" href="<?php echo e(route('schedule.index', array_merge(request()->except('page'), ['tab'=>'gedung']))); ?>">Gedung</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e($active=='ruang' ? 'active' : ''); ?>" href="<?php echo e(route('schedule.index', array_merge(request()->except('page'), ['tab'=>'ruang']))); ?>">Ruang</a>
        </li>
    </ul>

    

    
    <?php if($active == 'jadwal'): ?>
    <div class="card mb-3">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Ruang</th>
                        <th>Gedung</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($j->id_jadwal ?? $j->id); ?></td>
                        <td><?php echo e(ucfirst($j->hari)); ?></td>
                        <td><?php echo e($j->jam_mulai); ?> - <?php echo e($j->jam_selesai); ?></td>
                        <td><?php echo e($j->mataKuliah->nama_matkul ?? '-'); ?> <small class="text-muted">(<?php echo e($j->mataKuliah->kode_matkul ?? ''); ?>)</small></td>
                        <td><?php echo e(optional($j->dosen)->nama_dosen ?? '-'); ?></td>
                        <td><?php echo e(optional($j->ruang)->nama_ruang ?? '-'); ?></td>
                        <td><?php echo e(optional($j->ruang->gedung)->nama_gedung ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center">No data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>Menampilkan <?php echo e($jadwals->total()); ?> data</div>
            <div><?php echo e($jadwals->links()); ?></div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if($active == 'matkul'): ?>
    <div class="card mb-3">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr><th>#</th><th>Kode</th><th>Nama</th><th>SKS</th><th>Dosen</th></tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $matkuls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($m->id_matkul); ?></td>
                        <td><?php echo e($m->kode_matkul); ?></td>
                        <td><?php echo e($m->nama_matkul); ?></td>
                        <td><?php echo e($m->sks); ?></td>
                        <td><?php echo e(optional($m->dosen)->nama_dosen ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center">No data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <div>Menampilkan <?php echo e($matkuls->total()); ?> data</div>
            <div><?php echo e($matkuls->appends(request()->except('matkuls_page'))->links()); ?></div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if($active == 'gedung'): ?>
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div><strong>Gedung</strong></div>
            <div>
                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalAddGedung">Tambah Gedung</button>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <thead><tr><th>#</th><th>Nama Gedung</th><th>Jumlah Ruang</th><th>Aksi</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $gedungs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($g->id_gedung); ?></td>
                        <td><?php echo e($g->nama_gedung); ?></td>
                        <td><?php echo e($g->ruangs()->count()); ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-edit-gedung"
                                    data-id="<?php echo e($g->id_gedung); ?>"
                                    data-nama="<?php echo e($g->nama_gedung); ?>"
                                    data-bs-toggle="modal" data-bs-target="#modalEditGedung">
                                Edit
                            </button>

                            <form action="<?php echo e(route('gedung.destroy', $g->id_gedung)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus gedung ini? Semua ruang akan ikut terhapus jika ada.');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="text-center">No data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <div>Menampilkan <?php echo e($gedungs->total()); ?> data</div>
            <div><?php echo e($gedungs->appends(request()->except('gedungs_page'))->links()); ?></div>
        </div>
    </div>

    <!-- Modal Add Gedung -->
    <div class="modal fade" id="modalAddGedung" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form action="<?php echo e(route('gedung.store')); ?>" method="POST" class="modal-content">
          <?php echo csrf_field(); ?>
          <div class="modal-header">
            <h5 class="modal-title">Tambah Gedung</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Gedung</label>
              <input type="text" name="nama_gedung" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Edit Gedung -->
    <div class="modal fade" id="modalEditGedung" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form id="formEditGedung" method="POST" class="modal-content">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <div class="modal-header">
            <h5 class="modal-title">Edit Gedung</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_gedung" id="editGedungId">
            <div class="mb-3">
              <label class="form-label">Nama Gedung</label>
              <input type="text" name="nama_gedung" id="editGedungNama" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Update</button>
          </div>
        </form>
      </div>
    </div>
    <?php endif; ?>

    
    <?php if($active == 'ruang'): ?>
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div><strong>Ruang</strong></div>
            <div>
                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalAddRuang">Tambah Ruang</button>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table mb-0">
                <thead><tr><th>#</th><th>Nama Ruang</th><th>Gedung</th><th>Kapasitas</th><th>Aksi</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $ruangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($r->id_ruang); ?></td>
                        <td><?php echo e($r->nama_ruang); ?></td>
                        <td><?php echo e(optional($r->gedung)->nama_gedung ?? '-'); ?></td>
                        <td><?php echo e($r->kapasitas ?? '-'); ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-edit-ruang"
                                    data-id="<?php echo e($r->id_ruang); ?>"
                                    data-nama="<?php echo e($r->nama_ruang); ?>"
                                    data-gedung="<?php echo e($r->id_gedung); ?>"
                                    data-kapasitas="<?php echo e($r->kapasitas); ?>"
                                    data-bs-toggle="modal" data-bs-target="#modalEditRuang">
                                Edit
                            </button>

                            <form action="<?php echo e(route('ruang.destroy', $r->id_ruang)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus ruang ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center">No data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <div>Menampilkan <?php echo e($ruangs->total()); ?> data</div>
            <div><?php echo e($ruangs->appends(request()->except('ruangs_page'))->links()); ?></div>
        </div>
    </div>

    <!-- Modal Add Ruang -->
    <div class="modal fade" id="modalAddRuang" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form action="<?php echo e(route('ruang.store')); ?>" method="POST" class="modal-content">
          <?php echo csrf_field(); ?>
          <div class="modal-header">
            <h5 class="modal-title">Tambah Ruang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Ruang</label>
              <input type="text" name="nama_ruang" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Gedung</label>
              <select name="id_gedung" class="form-select" required>
                <option value="">-- Pilih Gedung --</option>
                <?php $__currentLoopData = $gedungs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ged): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($ged->id_gedung); ?>"><?php echo e($ged->nama_gedung); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Kapasitas</label>
              <input type="number" name="kapasitas" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Edit Ruang -->
    <div class="modal fade" id="modalEditRuang" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form id="formEditRuang" method="POST" class="modal-content">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <div class="modal-header">
            <h5 class="modal-title">Edit Ruang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editRuangId" name="id_ruang">
            <div class="mb-3">
              <label class="form-label">Nama Ruang</label>
              <input type="text" name="nama_ruang" id="editRuangNama" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Gedung</label>
              <select name="id_gedung" id="editRuangGedung" class="form-select" required>
                <option value="">-- Pilih Gedung --</option>
                <?php $__currentLoopData = $gedungs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ged): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($ged->id_gedung); ?>"><?php echo e($ged->nama_gedung); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Kapasitas</label>
              <input type="number" name="kapasitas" id="editRuangKapasitas" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Update</button>
          </div>
        </form>
      </div>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // base URLs (safer than hardcoding)
    const baseGedungUrl = "<?php echo e(url('gedung')); ?>";
    const baseRuangUrl = "<?php echo e(url('ruang')); ?>";

    // Gedung: populate edit modal
    document.querySelectorAll('.btn-edit-gedung').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;

            const idInput = document.getElementById('editGedungId');
            const namaInput = document.getElementById('editGedungNama');
            const form = document.getElementById('formEditGedung');

            if (idInput) idInput.value = id;
            if (namaInput) namaInput.value = nama;
            if (form) form.action = baseGedungUrl + '/' + id;
        });
    });

    // Ruang: populate edit modal
    document.querySelectorAll('.btn-edit-ruang').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const gedung = this.dataset.gedung;
            const kapasitas = this.dataset.kapasitas;

            const idInput = document.getElementById('editRuangId');
            const namaInput = document.getElementById('editRuangNama');
            const gedungSelect = document.getElementById('editRuangGedung');
            const kapasitasInput = document.getElementById('editRuangKapasitas');
            const form = document.getElementById('formEditRuang');

            if (idInput) idInput.value = id;
            if (namaInput) namaInput.value = nama || '';
            if (gedungSelect) gedungSelect.value = gedung || '';
            if (kapasitasInput) kapasitasInput.value = (kapasitas !== undefined && kapasitas !== null) ? kapasitas : '';
            if (form) form.action = baseRuangUrl + '/' + id;
        });
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.adminlayouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kuliah\notif-wa\resources\views/admin/schedule/index.blade.php ENDPATH**/ ?>