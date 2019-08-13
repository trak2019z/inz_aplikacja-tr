<div class="sidebar">
    <div class="sidebar--logo">
        <a href="#"></a>
    </div>

    <nav class="sidebar--nav">
        <p class="sidebar--nav--title">Klasa</p>
        <ul>
        <?php $__currentLoopData = $schoolrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php echo e(($active_schoolroom == $schoolroom->schoolroom_id) ? 'active' : ''); ?>"><a href="<?php echo e(url('index/'.$schoolroom->schoolroom_id.'/A')); ?>"><?php echo e($schoolroom->schoolroom_name); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>

    <footer class="sidebar--footer">
        <ul>
        <li><a href="<?php echo e(url('/')); ?>">Rozkład zajęć</a></li>
        <?php if(auth()->user()): ?>
            <li><a href="<?php echo e(url('logout')); ?>">Wyloguj się</a></li>
        <?php else: ?>
            <li><a href="<?php echo e(url('login')); ?>">Zaloguj się</a></li>
        <?php endif; ?>
        </ul>

        <p class="sidebar--footer--copyright">&copy; Copyright 2019</p>
    </footer>
    </div>
