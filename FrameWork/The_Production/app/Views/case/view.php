<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-10">
        <h2><?= esc($case['case_title']) ?></h2>
        
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Case Name:</strong> <?= esc($case['case_name']) ?></p>
                <p><strong>Author:</strong> <?= esc($case['author'] ?? 'N/A') ?></p>
                <p><strong>Status:</strong> <span class="badge bg-success"><?= esc($case['status']) ?></span></p>
                <p><strong>Description:</strong></p>
                <p><?= esc($case['case_description']) ?></p>
                
                <div class="mt-4">
                    <a href="<?= site_url('/case/edit/' . $case['id']) ?>" class="btn btn-warning">Edit Case</a>
                    <a href="<?= site_url('/case/list') ?>" class="btn btn-secondary">Back to Cases</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
