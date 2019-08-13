<?php $__env->startSection('content'); ?>

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">
        <div class="content--title--left">
        <h4>Klasy</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li class="active"><a href="<?php echo e(url('klasy')); ?>">Klasy</a></li>
        </ul>
        </div>
    </div>
    </div>
</div>

<?php if(Session::has('flash_message_error')): ?>
<div class="alert alert-danger"> <i class="icon-close"></i> <?php echo session('flash_message_error'); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
</div>
<?php endif; ?>
<?php if(Session::has('flash_message_success')): ?>
<div class="alert alert-success"> <i class="icon-check"></i> <?php echo session('flash_message_success'); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
</div>
<?php endif; ?>

<div class="content--buttons">
    <div class="row">
    <div class="col-xl-12">
        <div class="content--buttons--right">
        <a href="<?php echo e(url('klasy/dodaj')); ?>" class="btn btn-primary btn-md"><i class="icon-plus"></i> Dodaj klase</a>
        </div>
    </div>
    </div>
</div>

<div class="content--main">
    <div class="row">
    <div class="col-xl-12">
        <div class="component--search">
        <form action="">
            <input type="text" placeholder="Szukaj..." id="searchInput">
        </form>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="component--table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Nazwa</th>
                <th>Rozkład zajęć</th>
                <th>Akcja</th>
            </tr>
            </thead>
            <tbody id="fbody">
            <?php $__currentLoopData = $schoolrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($schoolroom->schoolroom_name); ?></td>
                <td><a href="<?php echo e(url('rozklad/'.$schoolroom->schoolroom_id.'/A' )); ?>" class="btn btn-sm btn-primary">Rozkład zajęć</a></td>
                <td class="action">
                <a href="<?php echo e(url('klasy/edytuj/'.$schoolroom->schoolroom_id )); ?>"><i class="icon-pencil"></i></a>
                <a href="javascript:;" class="remove-record" data-toggle="modal" data-target="#exampleModalCenter" data-url="<?php echo e(url('klasy/usun/'.$schoolroom->schoolroom_id )); ?>" data-id="<?php echo e($schoolroom->schoolroom_id); ?>" data-name="<?php echo e($schoolroom->schoolroom_name); ?>"><i class="icon-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

</main>

<form action="" method="POST" class="remove-record-model">
<?php echo csrf_field(); ?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Usunąć <strong><span class="modal-name"></span></strong>?</h5>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn-md btn-danger">Tak, usuwam</button>
            <button type="button" class="btn-md btn-grey remove-record-model" data-dismiss="modal">Anuluj</button>
        </div>
        </div>
    </div>
</div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default_design', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>