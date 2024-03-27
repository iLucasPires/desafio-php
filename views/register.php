
<body class="w-full h-screen relative">
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content">
            <div class="card shrink-0 md:w-[30vw] shadow-2xl bg-base-100">
                <form class="card-body" method="post">
                    <h2 class="card-title text-center">Register</h2>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Email</span></label>
                        <input type="email" name="email" placeholder="email" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Password</span></label>
                        <input type="password" name="password" placeholder="password" class="input input-bordered" required />
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Confirm password</span></label>
                        <input type="password" name="confirm_password" placeholder="Confirm password" class="input input-bordered" required />
                    </div>

                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Register</button>
                    </div>

                    <a href="/login" class="link mt-4 text-center">Already have an account? Login</a>
                </form>
            </div>
        </div>
    </div>
</body>