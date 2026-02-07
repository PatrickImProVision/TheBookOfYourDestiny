<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Create New Case</h2>
        
        <div class="card">
            <div class="card-body">
                <form action="<?= site_url('/case/create') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="case_name" class="form-label">Case Name</label>
                        <input type="text" class="form-control" id="case_name" name="case_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="case_title" class="form-label">Case Title</label>
                        <input type="text" class="form-control" id="case_title" name="case_title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="case_description" class="form-label">Description</label>
                        <textarea class="form-control" id="case_description" name="case_description" rows="4"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" name="author">
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Create Case</button>
                        <a href="<?= site_url('/case/list') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
