<?php
// footer.php - Footer with copyright and disclaimer
?>
</div> <!-- Close container-fluid from header -->
</div> <!-- Close container-fluid from main content -->
</main>

<style>
    /* Footer styles */
    .bg-dark {
        --bs-bg-opacity: 1;
        background-color: #000b27 !important;
    }
</style>

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">
                <p class="mb-0">&copy; <?= date('Y') ?> MERQ Consultancy. All rights reserved.</p>
                <button class="btn btn-link text-white p-0" data-bs-toggle="modal" data-bs-target="#sysDisclaimerModal">
                    <small>Confidentiality Disclaimer</small>
                </button>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Disclaimer Modal -->
<div class="modal fade" id="sysDisclaimerModal" tabindex="-1" aria-labelledby="sysDisclaimerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="sysDisclaimerModalLabel">Confidentiality Disclaimer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>CONFIDENTIALITY NOTICE:</strong> This performance evaluation system contains confidential information belonging to MERQ Consultancy.</p>
                <p>The information contained in this system is privileged and confidential, intended only for the use of authorized personnel. Any unauthorized access, use, disclosure, or distribution is strictly prohibited.</p>
                <p>All evaluation data, employee information, and performance metrics are sensitive and must not be shared with any employees, third parties, or unauthorized individuals.</p>
                <p>By accessing this system, you agree to maintain the confidentiality of all information contained herein and to use it only for official business purposes.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">I Understand</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // System sidebar functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sys-sidebar');
        const sidebarToggle = document.getElementById('sysSidebarToggle');
        const sidebarOverlay = document.getElementById('sysSidebarOverlay');
        const body = document.body;

        // Check if sidebar state is saved in localStorage
        const sidebarState = localStorage.getItem('sysSidebarState');
        if (sidebarState === 'collapsed') {
            body.classList.remove('sys-sidebar-expanded');
            body.classList.add('sys-sidebar-collapsed');
        }

        // Toggle sidebar
        sidebarToggle.addEventListener('click', function() {
            body.classList.toggle('sys-sidebar-expanded');
            body.classList.toggle('sys-sidebar-collapsed');

            // Save state to localStorage
            if (body.classList.contains('sys-sidebar-collapsed')) {
                localStorage.setItem('sysSidebarState', 'collapsed');
            } else {
                localStorage.setItem('sysSidebarState', 'expanded');
            }
        });

        // Close sidebar when clicking on overlay (mobile)
        sidebarOverlay.addEventListener('click', function() {
            body.classList.remove('sys-sidebar-expanded');
            body.classList.add('sys-sidebar-collapsed');
            localStorage.setItem('sysSidebarState', 'collapsed');
        });

        // Auto-collapse sidebar on mobile after navigation
        if (window.innerWidth < 769) {
            body.classList.remove('sys-sidebar-expanded');
            body.classList.add('sys-sidebar-collapsed');
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth < 769) {
                body.classList.remove('sys-sidebar-expanded');
                body.classList.add('sys-sidebar-collapsed');
            }
        });
    });
</script>
</body>

</html>