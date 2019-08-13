<?php $__env->startSection('content'); ?>

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">
        <div class="content--title--left">
        <h4>Dodaj</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li><a href="<?php echo e(url('klasy')); ?>">Klasy</a></li>
            <li class="active"><a href="<?php echo e(url('klasy/dodaj')); ?>">Dodaj zajęcia</a></li>
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
            <form method="POST" action="<?php echo e(url('rozklad/dodaj/'.$schoolroom->schoolroom_id.'/'.$active_week)); ?>" >
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Dzień</label>

                    <select class="custom-select" name="shedule_day">
                      <option value="1">Poniedziałek</option>
                      <option value="2">Wtorek</option>
                      <option value="3">Środa</option>
                      <option value="4">Czwartek</option>
                      <option value="5">Piątek</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tydzień</label>

                    <select class="custom-select" name="shedule_week">
                      <option value="A" <?php echo e(($active_week == 'A') ? 'selected' : ''); ?>>A</option>
                      <option value="B" <?php echo e(($active_week == 'B') ? 'selected' : ''); ?>>B</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Godzina rozpoczęcia</label>

                    <select class="custom-select" name="shedule_hour_start">
                        <?php for($i = 8; $i <= 20; $i++): ?>
                            <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>"><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
                        <?php endfor; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Minuta rozpoczęcia</label>

                    <select class="custom-select" name="shedule_minute_start">
                        <?php for($i = 0; $i <= 60; $i++): ?>
                            <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>"><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
                        <?php endfor; ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Godzina zakończenia</label>
    
                        <select class="custom-select" name="shedule_hour_end">
                            <?php for($i = 8; $i <= 20; $i++): ?>
                                <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>"><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
                            <?php endfor; ?>
                        </select>
                        </div>
    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Minuta zakończenia</label>
    
                        <select class="custom-select" name="shedule_minute_end">
                            <?php for($i = 0; $i <= 60; $i++): ?>
                                <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>"><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Przedmiot</label>

                    <select class="custom-select" name="subject_id">
                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subject->subject_id); ?>"><?php echo e($subject->subject_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nauczyciel</label>

                    <select class="custom-select" name="teacher_id">
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($teacher->teacher_id); ?>"><?php echo e($teacher->teacher_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Pokój</label>

                    <select class="custom-select" name="room_id">
                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($room->room_id); ?>"><?php echo e($room->room_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>


                  <button type="submit" class="btn-md btn-primary">Dodaj zajęcia</button>
                  <a href="<?php echo e(url('rozklad/'.$schoolroom->schoolroom_id.'/'.$active_week)); ?>" class="btn-md btn-grey">Anuluj</a>
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