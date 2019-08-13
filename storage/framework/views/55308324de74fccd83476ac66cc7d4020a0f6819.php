<?php $__env->startSection('content'); ?>

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">Ustawienia
        <div class="content--title--left">
        <h4>Edytuj</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li class="active"><a href="<?php echo e(url('ustawienia')); ?>">Ustawienia</a></li>
        </ul>
        </div>
    </div>
    </div>
</div>

<div class="content--main">

    <div class="row">
    <div class="col-xl-12">

        <div class="component--form">
        <div class="row">
            <div class="col-xl-6">
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
            <form method="POST" action="<?php echo e(url('ustawienia')); ?>" >
            <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Adres mail do wysyłki powiadomień</label>
                    <input type="text" class="form-control" name="mail_sender" value="<?php echo e($settings->mail_sender); ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nowe hasło temat wiadomości:</label>
                    <input type="text" class="form-control" name="password_reset_notification_subject" value="<?php echo e($settings->password_reset_notification_subject); ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nowe Hasło treść wiadomości:</label>
                    <textarea class="form-control" name="password_reset_notification_content"><?php echo e($settings->password_reset_notification_content); ?></textarea>
                </div>
                <button type="submit" class="btn-md btn-primary">Zapisz ustawienia</button>
                <a href="<?php echo e(url('ustawienia')); ?>" class="btn-md btn-grey">Anuluj</a>
            </form>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>

</main>

<?php $__env->stopSection(); ?>
    
<?php echo $__env->make('layouts.default_design', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>