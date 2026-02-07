<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <h2>📝 Edit Content</h2>
        
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Case ID:</strong> <?= esc($caseId) ?></p>
                        <p><strong>Book ID:</strong> <?= esc($bookId) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Page ID:</strong> <?= esc($pageId) ?></p>
                        <p><strong>Section ID:</strong> <?= esc($sectionId) ?></p>
                    </div>
                </div>
                
                <hr>
                
                <h4>WYSIWYG Editor</h4>
                <p class="text-muted">TinyMCE editor will be integrated here with support for:</p>
                <ul>
                    <li>HTML5 content editing</li>
                    <li>Image insertion and resizing</li>
                    <li>Audio/Video insertion</li>
                    <li>Text formatting (H1-H6, fonts, alignment)</li>
                    <li>URI linking</li>
                    <li>Media upload with filesystem support</li>
                </ul>
                
                <div class="alert alert-info mt-4">
                    <strong>Note:</strong> WYSIWYG Editor component will be implemented in the next phase with TinyMCE integration.
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
