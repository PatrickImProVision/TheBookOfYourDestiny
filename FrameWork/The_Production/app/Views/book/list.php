<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Books</h2>
            <a href="<?= site_url('/book/create') ?>" class="btn btn-primary">+ New Book</a>
        </div>

        <?php if (!empty($books)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?= esc($book['canonical_id'] ?? $book['id']) ?></td>
                                <td><?= esc($book['book_title']) ?></td>
                                <td><?= esc($book['book_type'] ?? 'N/A') ?></td>
                                <td><?= esc($book['book_author'] ?? 'N/A') ?></td>
                                <td><?= esc($book['status'] ?? 'active') ?></td>
                                <td><?= $book['created_at'] ?></td>
                                <td>
                                    <a href="<?= site_url('/book/view/' . $book['id']) ?>" class="btn btn-sm btn-info">View</a>
                                    <a href="<?= site_url('/book/edit/' . $book['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('/book/delete/' . $book['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this book?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                No books found. <a href="<?= site_url('/book/create') ?>">Create one now</a>.
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
