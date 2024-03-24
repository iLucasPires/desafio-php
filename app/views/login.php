<?php
require_once 'partials/head.php';
require_once 'partials/alert.php';
?>

<body class="w-full h-screen relative">
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content">
            <div class="card shrink-0 md:w-[30vw] shadow-2xl bg-base-100">
                <form class="card-body" method="post">
                    <h2 class="card-title text-center">Login</h2>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Email</span></label>
                        <input type="email" placeholder="email" class="input input-bordered" name="email" required />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Password</span></label>
                        <input type="password" placeholder="password" class="input input-bordered" name="password" required />
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Login</button>
                    </div>
                    <a href="/register" class="link mt-4 text-center">Don't have an account? Register</a>
                </form>
            </div>
        </div>
    </div>
</body>