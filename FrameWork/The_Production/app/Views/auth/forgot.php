<?php echo view('layout/base', ['title' => 'Forgot Password']); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4">Reset Your Password</h2>

                    <p class="text-muted text-center mb-4">
                        Enter your email address and we'll send you a link to reset your password.
                    </p>

                    <?php if (session()->has('message')): ?>
                        <div class="alert alert-info alert-dismissible fade show">
                            <?php echo esc(session('message')); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form id="forgotForm" class="needs-validation" novalidate>
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

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-paper-plane"></i> Send Reset Link
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
document.getElementById('forgotForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    
    try {
        const response = await fetch('<?php echo base_url('/auth/forgot-password'); ?>', {
            method: 'POST',
            body: formData,
        });
        
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('forgotForm').reset();
            alert('Check your email for password reset instructions.');
            setTimeout(() => {
                window.location.href = '<?php echo base_url('/auth/login'); ?>';
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
