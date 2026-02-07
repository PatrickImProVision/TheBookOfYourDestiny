<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="card-title">Welcome to The Book Of Your Destiny</h1>
                <p class="card-text lead">A Micro‑Store MVC FrameWork for E-Book Management</p>
                
                <p class="mt-4">
                    <strong>By The Will Of God, The Fundamental Stone Of Life</strong>
                </p>
                
                <div class="mt-5">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="<?= site_url('/case/list') ?>" class="btn btn-primary btn-lg w-100">
                                📦 Manage Cases
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= site_url('/book/list') ?>" class="btn btn-primary btn-lg w-100">
                                📚 Manage Books
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= site_url('/page/list') ?>" class="btn btn-primary btn-lg w-100">
                                📄 Manage Pages
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= site_url('/new.app') ?>" class="btn btn-success btn-lg w-100">
                                ➕ Create New
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
