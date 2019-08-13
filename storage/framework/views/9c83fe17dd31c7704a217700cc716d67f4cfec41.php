<?php $__env->startSection('content'); ?>

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">
        <div class="content--title--left">
        <h4>Edytuj</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li><a href="<?php echo e(url('klasy')); ?>">Klasy</a></li>
            <li class="active"><a href="<?php echo e(url('klasy/edytuj/'.$schoolroom->schoolroom_id.'/'.$active_week.'/'.$shedule->shedule_id)); ?>">Edytuj zajęcia</a></li>
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
            <form method="POST" action="<?php echo e(url('rozklad/edytuj/'.$schoolroom->schoolroom_id.'/'.$active_week.'/'.$shedule->shedule_id)); ?>" >
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Dzień</label>

                    <select class="custom-select" name="shedule_day">
                      <option value="1" <?php echo e(($shedule->shedule_day == '1') ? 'selected' : ''); ?>>Poniedziałek</option>
                      <option value="2" <?php echo e(($shedule->shedule_day == '2') ? 'selected' : ''); ?>>Wtorek</option>
                      <option value="3" <?php echo e(($shedule->shedule_day == '3') ? 'selected' : ''); ?>>Środa</option>
                      <option value="4" <?php echo e(($shedule->shedule_day == '4') ? 'selected' : ''); ?>>Czwartek</option>
                      <option value="5" <?php echo e(($shedule->shedule_day == '5') ? 'selected' : ''); ?>>Piątek</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tydzień</label>

                    <select class="custom-select" name="shedule_week">
                      <option value="A" <?php echo e(($shedule->shedule_week == 'A') ? 'selected' : ''); ?>>A</option>
                      <option value="B" <?php echo e(($shedule->shedule_week == 'B') ? 'selected' : ''); ?>>B</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Godzina rozpoczęcia</label>

                    <select class="custom-select" name="shedule_hour_start">
                        <?php for($i = 8; $i <= 20; $i++): ?>
                            <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>" <?php echo e(($start_hour_pieces[0] == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : ''); ?>><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
                        <?php endfor; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Minuta rozpoczęcia</label>

                    <select class="custom-select" name="shedule_minute_start">
                        <?php for($i = 0; $i <= 60; $i++): ?>
                            <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>" <?php echo e(($start_hour_pieces[1] == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : ''); ?>><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
                        <?php endfor; ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Godzina zakończenia</label>
    
                        <select class="custom-select" name="shedule_hour_end">
                            <?php for($i = 8; $i <= 20; $i++): ?>
                                <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>" <?php echo e(($end_hour_pieces[0] == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : ''); ?>><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
                            <?php endfor; ?>
                        </select>
                        </div>
    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Minuta zakończenia</label>
    
                        <select class="custom-select" name="shedule_minute_end">
                            <?php for($i = 0; $i <= 60; $i++): ?>
                                <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>" <?php echo e(($end_hour_pieces[1] == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : ''); ?>><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Przedmiot</label>

                    <select class="custom-select" name="subject_id">
                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subject->subject_id); ?>" <?php echo e(($shedule->subject_id == $subject->subject_id) ? 'selected' : ''); ?>><?php echo e($subject->subject_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nauczyciel</label>

                    <select class="custom-select" name="teacher_id">
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($teacher->teacher_id); ?>" <?php echo e(($shedule->teacher_id == $teacher->teacher_id) ? 'selected' : ''); ?>><?php echo e($teacher->teacher_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Pokój</label>

                    <select class="custom-select" name="room_id">
                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($room->room_id); ?>" <?php echo e(($shedule->room_id == $room->room_id) ? 'selected' : ''); ?>><?php echo e($room->room_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>


                  <button type="submit" class="btn-md btn-primary">Zapisz zajęcia</button>
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