

<?php $__env->startSection('title', 'Dashboard Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <!-- Halo user -->
    <div class="mb-4">
        <h1><i class="fa fa-user"></i> Dashboard Mahasiswa</h1>
        <p>Selamat datang, <?php echo e(Auth::user()?->nama_user ?? 'Mahasiswa'); ?>!</p>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-calendar"></i> Jadwal Hari Ini</h5>
                    <p class="card-text display-4"><?php echo e($jumlahJadwal); ?></p>
                </div>
            </div>
        </div>
        <!-- contoh card lain, ganti angka dengan data nyata bila tersedia -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-bell"></i> Pengingat Aktif</h5>
                    <p class="card-text display-4"><?php echo e($jumlahPengingat); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-book"></i> Mata Kuliah</h5>
                    <p class="card-text display-4"><?php echo e($jumlahMatkul); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    <div class="mb-4">
        <h4><i class="fa fa-calendar-alt"></i> Jadwal Hari <?php echo e($hariInText); ?></h4>

        <?php if($jadwalHariIni->isEmpty()): ?>
            <div class="alert alert-info">Belum ada jadwal untuk hari ini.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>Ruang</th>
                        <th>Dosen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $jadwalHariIni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($loop->first ? 'table-info' : ''); ?>">
                            <td><?php echo e(\Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')); ?>

                                - <?php echo e(\Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')); ?></td>
                            <td><?php echo e($jadwal->mataKuliah->nama_matkul ?? '-'); ?></td>
                            <td><?php echo e($jadwal->ruang->nama_ruang ?? '-'); ?></td>
                            <td><?php echo e($jadwal->mataKuliah->nama_dosen ?? '—'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Daftar Pengingat -->
  <div class="mb-4">
    <h4><i class="fa fa-bell"></i> Pengingat Mendatang</h4>

    <?php if($pengingatMendatang->isEmpty()): ?>
        <p class="text-muted">Tidak ada pengingat mendatang</p>
    <?php else: ?>
        <ul class="list-group">
            <?php $__currentLoopData = $pengingatMendatang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengingat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo e($pengingat->judul); ?>


                    <span class="badge badge-primary rounded-pill">
                        
                        <?php if($pengingat->nama_hari): ?>
                            <?php echo e($pengingat->nama_hari); ?>

                        <?php endif; ?>

                        
                        <?php if($pengingat->waktu_carbon): ?>
                            , <?php echo e($pengingat->waktu_carbon->format('H:i')); ?>

                        <?php endif; ?>

                        
                        <?php if(!$pengingat->nama_hari && !$pengingat->waktu_carbon): ?>
                            —
                        <?php endif; ?>
                    </span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.userlayouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kuliah\notif-wa\resources\views/mahasiswa/dashboard/index.blade.php ENDPATH**/ ?>