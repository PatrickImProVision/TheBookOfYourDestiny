<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Pages</h2>
            <a href="<?= site_url('/page/create') ?>" class="btn btn-primary">+ New Page</a>
        </div>

        <?php if (!empty($pages)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Book</th>
                            <th>Section</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page): ?>
                            <tr>
                                <td><?= esc($page['canonical_id'] ?? $page['id']) ?></td>
                                <td><?= esc($page['page_title']) ?></td>
                                <td><?= esc($page['book_id'] ?? 'N/A') ?></td>
                                <td><?= esc($page['section_type'] ?? 'N/A') ?></td>
                                <td><?= $page['created_at'] ?></td>
                                <td>
                                    <a href="<?= site_url('/page/view/' . $page['id']) ?>" class="btn btn-sm btn-info">View</a>
                                    <a href="<?= site_url('/edit.app?PageID=' . $page['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('/page/delete/' . $page['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this page?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                No pages found. <a href="<?= site_url('/page/create') ?>">Create one now</a>.
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
