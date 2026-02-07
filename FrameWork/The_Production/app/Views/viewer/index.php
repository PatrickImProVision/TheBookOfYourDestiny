<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <h2>👁️ View Content</h2>
        
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
                
                <h4>Content Display Area</h4>
                <p class="text-muted">This is a read-only view of the content selected above.</p>
                
                <div class="alert alert-info mt-4">
                    <strong>Note:</strong> Content rendering engine will fetch and display page content with support for:
                    <ul>
                        <li>HTML5 rendering</li>
                        <li>Image display with alignment</li>
                        <li>Audio/Video playback</li>
                        <li>Full text search highlighting</li>
                        <li>Theme switching (Light/Dark)</li>
                        <li>Responsive A5 book view</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
