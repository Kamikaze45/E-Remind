

<?php $__env->startSection('title', 'Pengingat'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1><i class="fa fa-bell"></i> Pengingat</h1>
</div>
   <div class="mb-3 d-flex justify-content-between align-items-center">
    <form class="form-inline d-flex" method="GET" action="<?php echo e(route('pengingat.index')); ?>">
        <div class="input-group mr-2">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="Cari judul..." />
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>

        <div class="form-group mr-2">
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="" <?php echo e(request('status') === null || request('status')==='' ? 'selected' : ''); ?>>Semua</option>
                <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Aktif</option>
                <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
            </select>
        </div>

        <a href="<?php echo e(route('pengingat.index')); ?>" class="btn btn-outline-secondary">Reset</a>
    </form>

    
    <div>
        <a href="<?php echo e(route('pengingat.create')); ?>" class="btn btn-primary">Tambah Pengingat</a>
    </div>
</div>


    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Judul</th>
                        <th>Hari</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th style="width:130px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pengingat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($p->judul); ?></td>

                        
                        <td><?php echo e($p->nama_hari ?? '-'); ?></td>

                        
                        <td><?php echo e(optional($p->waktu_carbon)->format('H:i') ?? '-'); ?></td>

                        <td>
                            <?php if($p->is_active): ?>
                                <span class="badge bg-success text-white">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary text-white">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
    
    <form action="<?php echo e(route('pengingat.toggle', $p->id_pengingat)); ?>" method="POST" class="d-inline">
        <?php echo csrf_field(); ?>
        <button class="btn btn-sm btn-warning" title="Toggle Status">
            <i class="fa fa-power-off"></i>
        </button>
    </form>

    
    <a href="<?php echo e(route('pengingat.edit', $p->id_pengingat)); ?>" class="btn btn-sm btn-info text-white" title="Edit">
        <i class="fa fa-edit"></i>
    </a>

    
    <form action="<?php echo e(route('pengingat.destroy', $p->id_pengingat)); ?>" method="POST" class="d-inline"
        onsubmit="return confirm('Hapus pengingat ini?')">
        <?php echo csrf_field(); ?>
        <button class="btn btn-sm btn-danger" title="Hapus">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center p-3">Belum ada pengingat.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <?php echo e($pengingat->links()); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.dosenlayouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kuliah\notif-wa\resources\views/pengingat/index.blade.php ENDPATH**/ ?>