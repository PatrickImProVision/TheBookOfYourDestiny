<?php echo view('layout/base', ['title' => 'User Login']); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4">Login to Your Account</h2>

                    <?php if (session()->has('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Login Failed!</strong>
                            <?php foreach (session('errors') as $error): ?>
                                <div><?php echo esc($error); ?></div>
                            <?php endforeach; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('message')): ?>
                        <div class="alert alert-info alert-dismissible fade show">
                            <?php echo esc(session('message')); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form id="loginForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                required 
                                autofocus
                                placeholder="your@email.com"
                            >
                            <div class="invalid-feedback">
                                Please enter a valid email address
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                name="password" 
                                required 
                                placeholder="••••••••"
                            >
                            <div class="invalid-feedback">
                                Please enter your password
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="remember" 
                                name="remember"
                            >
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-sign-in-alt"></i> Sign In
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-2">
                            <a href="<?php echo base_url('/auth/forgot'); ?>" class="text-decoration-none">
                                Forgot your password?
                            </a>
                        </p>
                        <p>
                            Don't have an account? 
                            <a href="<?php echo base_url('/auth/register'); ?>" class="text-decoration-none fw-bold">
                                Create one now
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    
    try {
        const response = await fetch('<?php echo base_url('/auth/login'); ?>', {
            method: 'POST',
            body: formData,
        });
        
        const data = await response.json();
        
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            // Show errors
            const errorHtml = Object.values(data.errors || {}).flat().join('<br>');
            alert('Login Error:\n' + (data.message || errorHtml));
        }
    } catch (error) {
        alert('An error occurred: ' + error.message);
    }
});
</script>

<?php echo view('layout/footer'); ?>
