<?php require_once __DIR__ . '/partials/head.php';?>

<main class="hero min-h-screen bg-base-200">
  <div class="hero-content w-full">
    <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
      <form class="card-body" action="<?= $title === 'login' ? '/login' : '/register'; ?>" method="POST">
        <h1 class="card-title capitalize"><?= $title; ?></h1>
        <div class="form-control">
          <label class="label"><span class="label-text">Email</span></label>
          <input title="email" placeholder="email" class="input input-bordered" name="email" required />
        </div>
        <div class="form-control">
          <label class="label"><span class="label-text">Password</span></label>
          <input title="password" type="password" placeholder="password" class="input input-bordered" name="password" required />
        </div>

        <?php if ($title === 'register'): ?>
          <label class="label"><span class="label-text">Confirm Password</span></label>
          <input title="confirm" type="password" placeholder="confirm password" class="input input-bordered" name="confirm" required />
        <?php endif;?>

        <div class="form-control mt-6">
          <button class="btn btn-primary"><?= $title; ?></button>
        </div>

        <a 
          href="<?= $title === 'login' ? '/register' : '/login'; ?>" 
          class="link text-center text-base-content/70">
            <?= $title === 'login' 
              ? 'Don\'t have an account?'
              : 'Already have an account?';
            ?>
        </a>
      </form>
    </div>
  </div>
</main>

<?php require_once __DIR__ . '/partials/tail.php';?>