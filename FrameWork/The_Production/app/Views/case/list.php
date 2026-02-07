<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cases</h2>
            <a href="<?= site_url('/case/create') ?>" class="btn btn-primary">+ New Case</a>
        </div>

        <?php if (!empty($cases)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cases as $case): ?>
                            <tr>
                                <td><?= esc($case['canonical_id'] ?? $case['id']) ?></td>
                                <td><?= esc($case['case_name']) ?></td>
                                <td><?= esc($case['case_title']) ?></td>
                                <td><?= esc($case['author'] ?? 'N/A') ?></td>
                                <td><?= esc($case['status'] ?? 'active') ?></td>
                                <td><?= $case['created_at'] ?></td>
                                <td>
                                    <a href="<?= site_url('/case/view/' . $case['id']) ?>" class="btn btn-sm btn-info">View</a>
                                    <a href="<?= site_url('/case/edit/' . $case['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('/case/delete/' . $case['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this case?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                No cases found. <a href="<?= site_url('/case/create') ?>">Create one now</a>.
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
