<?php echo view('layout/base', ['title' => 'Reset Password']); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4">Create New Password</h2>

                    <p class="text-muted text-center mb-4">
                        Enter your new password below.
                    </p>

                    <form id="resetForm" class="needs-validation" novalidate>
                        <input type="hidden" name="token" value="<?php echo esc($token); ?>">

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                name="password" 
                                required 
                                autofocus
                                placeholder="••••••••"
                                minlength="8"
                            >
                            <div class="form-text">Minimum 8 characters</div>
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

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-lock"></i> Reset Password
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p>
                            Remember your password? 
                            <a href="<?php echo base_url('/auth/login'); ?>" class="text-decoration-none">
                                Sign in instead
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('resetForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password_confirm').value;
    
    if (password !== passwordConfirm) {
        alert('Passwords do not match');
        return;
    }
    
    const formData = new FormData(e.target);
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Resetting...';
    
    try {
        const response = await fetch('<?php echo base_url('/auth/reset-password'); ?>', {
            method: 'POST',
            body: formData,
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('Password reset successfully! Redirecting to login...');
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 2000);
        } else {
            alert('Error: ' + (data.message || 'Please try again'));
        }
    } catch (error) {
        alert('An error occurred: ' + error.message);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
});
</script>

<?php echo view('layout/footer'); ?>
