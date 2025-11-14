

<?php $__env->startSection('title', 'User Management'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.card-user-table {
    background: #fff;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.04);
}
.table tbody tr:hover { background: #f8f9fa; }
.avatar-sm { width:40px; height:40px; object-fit:cover; border-radius:50%; }
.badge-status { font-size: .8rem; padding: .35em .6em; }
.action-btn-group .dropdown-menu { min-width: 140px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h2"><li class="fa fa-users"></li> User Management</h1>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="card card-user-table mb-3">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.users')); ?>" class="form-row align-items-center mb-3">
                <div class="col-auto">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Search name or email...">
                </div>
                <div class="col-auto">
                    <select name="status" class="form-control">
                        <option value="all" <?php echo e(request('status','all')=='all' ? 'selected' : ''); ?>>All Status</option>
                        <option value="pending" <?php echo e(request('status')=='pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="approved" <?php echo e(request('status')=='approved' ? 'selected' : ''); ?>>Approved</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-primary">Filter</button>
                    <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-link">Reset</a>
                </div>
                <div class="col text-right">
                    <small class="text-muted">Total: <?php echo e($users->total()); ?> user</small>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th style="width:130px">Status</th>
                            <th style="width:140px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                           
                            <td>
                                
                                <?php if($user->profile && $user->profile->foto_profil): ?>
                         <img src="<?php echo e(asset('storage/' . $user->profile->foto_profil)); ?>" 
                         alt="Foto Profil" class="rounded-circle me-2" 
                         style="width: 40px; height: 40px; object-fit: cover;">
                        <?php else: ?>
                                    <span class="mr-2"><i class="fa fa-user-circle fa-2x text-secondary"></i></span>
                                <?php endif; ?>
                                <?php echo e($user->nama_user); ?>

                            </td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->role); ?></td>
                            <td>
                                <?php if($user->status == 'pending'): ?>
                                    <span class="badge badge-status bg-warning text-dark">Pending</span>
                                <?php elseif($user->status == 'approved'): ?>
                                    <span class="badge badge-status bg-success text-white">Approved</span>
                                <?php elseif($user->status == 'admin'): ?>
                                    <span class="badge badge-status bg-primary text-white">Admin</span>
                                <?php elseif($user->status == 'dosen'): ?>
                                    <span class="badge badge-status bg-info text-white">Dosen</span>
                                <?php else: ?>
                                    <span class="badge badge-status bg-secondary text-white"><?php echo e(ucfirst($user->status)); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group action-btn-group" role="group">
                                    
                                    <form action="<?php echo e(route('admin.users.approve', $user->id_user)); ?>" method="POST" class="mr-1">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-success" <?php echo e($user->status == 'approved' ? 'disabled' : ''); ?> 
                                            onclick="return confirm('Setujui user <?php echo e($user->nama_user); ?>?')">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>

                                    
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right">
                                        
                                        <a class="dropdown-item" href="<?php echo e(route('admin.users')); ?>?view=<?php echo e($user->id_user); ?>"><i class="fa fa-eye mr-1"></i> View</a>

                                        <div class="dropdown-divider"></div>

                                        <form action="<?php echo e(route('admin.users.delete', $user->id_user)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus user <?php echo e($user->nama_user); ?>?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="dropdown-item text-danger" type="submit"><i class="fa fa-trash mr-1"></i> Delete</button>
                                        </form>
                                        <form action="<?php echo e(route('admin.users.resetPassword', $user->id_user)); ?>" method="POST"
      onsubmit="return confirm('Reset password user <?php echo e($user->nama_user); ?> ke default?')">
    <?php echo csrf_field(); ?>
    <button class="dropdown-item" type="submit">
        <i class="fa fa-key mr-1"></i> Reset Password
    </button>
</form>

                                      </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center">Tidak ada user.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Menampilkan <?php echo e($users->firstItem() ?? 0); ?> - <?php echo e($users->lastItem() ?? 0); ?> dari <?php echo e($users->total()); ?></small>
                </div>
                <div>
                    <?php echo e($users->links()); ?>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adminlayouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kuliah\notif-wa\resources\views/admin/users/index.blade.php ENDPATH**/ ?>