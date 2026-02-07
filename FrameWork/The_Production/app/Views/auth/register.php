<?php echo view('layout/base', ['title' => 'Create Account']); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4">Create Your Account</h2>

                    <?php if (session()->has('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Registration Failed!</strong>
                            <?php foreach (session('errors') as $error): ?>
                                <div><?php echo esc($error); ?></div>
                            <?php endforeach; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form id="registerForm" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="first_name" 
                                    name="first_name" 
                                    required 
                                    placeholder="John"
                                >
                                <div class="invalid-feedback">
                                    Please enter your first name
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="last_name" 
                                    name="last_name" 
                                    required 
                                    placeholder="Doe"
                                >
                                <div class="invalid-feedback">
                                    Please enter your last name
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="username" 
                                name="username" 
                                required 
                                placeholder="johndoe"
                                minlength="3"
                                maxlength="100"
                            >
                            <div class="form-text">3-100 characters, letters and numbers only</div>
                            <div class="invalid-feedback">
                                Please enter a valid username
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                required 
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
                                minlength="8"
                            >
                            <div class="form-text">Minimum 8 characters, include uppercase, numbers, and symbols</div>
                            <div class="invalid-feedback">
                                Please enter a strong password
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirm Password</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password_confirm" 
                                name="password_confirm" 
                                required 
                                placeholder="••••••••"
                            >
                            <div class="invalid-feedback">
                                Passwords do not match
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="agree" 
                                name="agree" 
                                required
                            >
                            <label class="form-check-label" for="agree">
                                I agree to the Terms of Service and Privacy Policy
                            </label>
                            <div class="invalid-feedback">
                                You must agree to the terms
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-user-plus"></i> Create Account
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p>
                            Already have an account? 
                            <a href="<?php echo base_url('/auth/login'); ?>" class="text-decoration-none fw-bold">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Check if passwords match
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password_confirm').value;
    
    if (password !== passwordConfirm) {
        alert('Passwords do not match');
        return;
    }
    
    const formData = new FormData(e.target);
    
    try {
        const response = await fetch('<?php echo base_url('/auth/register'); ?>', {
            method: 'POST',
            body: formData,
        });
        
        const data = await response.json();
        
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            const errorHtml = Object.values(data.errors || {}).flat().join('\n');
            alert('Registration Error:\n' + (data.message || errorHtml));
        }
    } catch (error) {
        alert('An error occurred: ' + error.message);
    }
});
</script>

<?php echo view('layout/footer'); ?>
