<div class="sidebar">
    <div class="sidebar--logo">
        <a href="#">LOGO</a>
    </div>

    <nav class="sidebar--nav">
        <p class="sidebar--nav--title">Rozkład zajęć</p>
        <ul>
        <li class="<?php echo e(request()->is('klasy*') ||  request()->is('rozklad*') ? 'active' : ''); ?>"><a href="<?php echo e(url('klasy')); ?>"><i class="icon-calendar"></i> Klasy</a></li>
        </ul>
    </nav>

    <nav class="sidebar--nav">
        <p class="sidebar--nav--title">Dane</p>
        <ul>
        <li class="<?php echo e(request()->is('nauczyciele*') ? 'active' : ''); ?>"><a href="<?php echo e(url('nauczyciele')); ?>"><i class="icon-user"></i> Nauczyciele</a></li>
        <li class="<?php echo e(request()->is('przedmioty*') ? 'active' : ''); ?>"><a href="<?php echo e(url('przedmioty')); ?>"><i class="icon-layers"></i> Przedmioty</a></li>
        <li class="<?php echo e(request()->is('pokoje*') ? 'active' : ''); ?>"><a href="<?php echo e(url('pokoje')); ?>"><i class="icon-login"></i> Pokoje</a></li>
        </ul>
    </nav>

    <nav class="sidebar--nav">
        <p class="sidebar--nav--title">Ustawienia</p>
        <ul>
        <li class="<?php echo e(request()->is('uzytkownicy*') ? 'active' : ''); ?>"><a href="<?php echo e(url('uzytkownicy')); ?>"><i class="icon-user"></i> Użytkownicy</a></li>
        <li class="<?php echo e(request()->is('ustawienia*') ? 'active' : ''); ?>"><a href="<?php echo e(url('ustawienia')); ?>"><i class="icon-layers"></i> Ustawienia</a></li>
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
  