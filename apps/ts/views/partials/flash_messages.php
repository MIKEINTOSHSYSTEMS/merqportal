<!-- Flash Messages -->
<?php if (!empty($flashMessages)): ?>
<div class="container-fluid px-3 px-lg-4 mt-3">
    <?php foreach ($flashMessages as $flash): ?>
        <div class="alert alert-<?php
            echo $flash['type'] == 'error' ? 'danger' :
                 ($flash['type'] == 'success' ? 'success' :
                 ($flash['type'] == 'warning' ? 'warning' : 'info'));
            ?> alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-<?php
                    echo $flash['type'] == 'error' ? 'exclamation-triangle-fill' :
                         ($flash['type'] == 'success' ? 'check-circle-fill' : 'info-circle-fill');
                    ?> me-2"></i>
                <span><?php echo htmlspecialchars($flash['message']); ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>