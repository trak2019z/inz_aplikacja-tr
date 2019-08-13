
<!DOCTYPE html>
<html lang="pl-PL" class="fullHeight">
<head>
    <title>Framework</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Framework" />
    <meta name="author" content="Damian Komoński">
    <meta charset="UTF-8" />

    <link rel="icon" type="image/ico" href="<?php echo e(asset('public/favicon.ico')); ?>" />
    <link href="<?php echo e(asset('public/css/style.min.css')); ?>" rel="stylesheet" />
</head>
<body  class="fullHeight">

  <div class="component--signin fullHeight flexCenter">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 flex">
          <div class="component--signin--left"></div>

          <div class="component--signin--right">
            <!--
            <div class="alert alert-success" role="alert">
              <i class="icon-check"></i> Hasło zostało zresetowane.
            </div>
            -->
            <?php if(session()->has('login_custom_error')): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="icon-close"></i><?php echo e(session()->get('login_custom_error')); ?>

                </div>
            <?php endif; ?>
            <h4>Zaloguj się</h4>
            <p>Zaloguj się do Panelu Administratora Rozkładu Zajęć</p>

            <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
            <?php echo csrf_field(); ?>
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Wpisz email">
              </div>

              <div class="form-group">
                <label for="">Hasło</label>
                <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Hasło">
                <small id="emailHelp" class="form-text text-muted"><a href="<?php echo e(url('resetuj-haslo')); ?>">Zapomniałem hasła</a></small>
              </div>

              <div class="form-check">
                <input type="checkbox" value="" id="remember">
                <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
              </div>

              <button class="btn-md btn-primary">Zaloguj się</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="<?php echo e(asset('public/js/jquery-3.3.1.slim.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/scripts.js')); ?>"></script>
</body>
</html>


<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Login')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                       

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Login')); ?>

                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
