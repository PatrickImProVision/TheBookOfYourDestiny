<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>➕ Create New Content</h2>
        
        <div class="card">
            <div class="card-body">
                <p class="lead">What would you like to create?</p>
                
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <a href="<?= site_url('/case/create') ?>" class="btn btn-primary btn-lg w-100 p-4">
                            <div>📦</div>
                            <div>New Case</div>
                            <small>A container for books</small>
                        </a>
                    </div>
                    
                    <div class="col-md-6">
                        <a href="<?= site_url('/book/create') ?>" class="btn btn-info btn-lg w-100 p-4">
                            <div>📚</div>
                            <div>New Book</div>
                            <small>A collection of pages</small>
                        </a>
                    </div>
                </div>
                
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <a href="<?= site_url('/page/create') ?>" class="btn btn-success btn-lg w-100 p-4">
                            <div>📄</div>
                            <div>New Page</div>
                            <small>Content with text, images, media</small>
                        </a>
                    </div>
                    
                    <div class="col-md-6">
                        <a href="<?= site_url('/') ?>" class="btn btn-secondary btn-lg w-100 p-4">
                            <div>🏠</div>
                            <div>Back Home</div>
                            <small>Return to main dashboard</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
