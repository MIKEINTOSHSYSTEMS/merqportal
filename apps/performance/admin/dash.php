<?php
// dash.php - Main dashboard page (enhanced with multi-filters, always-visible values, and no-data placeholders)
require_once 'config.php';

// Fetch and process data
$submissions = getSubmissions();
$employeeEvaluations = calculateWeightedScores($submissions);

// Get employees from database for filters
$employeesFromDB = getEmployeesFromDatabase();

// --- Handle filters (multi-select via checkboxes) ---
$selectedEmployees    = isset($_GET['employee'])    ? array_filter((array)$_GET['employee'])    : [];
$selectedPerspectives = isset($_GET['perspective']) ? array_filter((array)$_GET['perspective']) : [];
$selectedCategories   = isset($_GET['category'])    ? array_filter((array)$_GET['category'])    : [];

// Helper to build query string for export links (supports repeated params like employee[])
function build_query_string(array $params): string
{
    return http_build_query($params, '', '&', PHP_QUERY_RFC3986);
}

// --- Filter evaluations strictly based on selected filters ---
$filteredEvaluations = [];
foreach ($employeeEvaluations as $employeeId => $data) {
    $matches = true;

    // Employee filter: include only selected employees (OR across employees)
    if (!empty($selectedEmployees) && !in_array($employeeId, $selectedEmployees, true)) {
        $matches = false;
    }

    // Perspective filter: include if the employee has at least one of the selected perspectives with count > 0 (OR logic)
    if ($matches && !empty($selectedPerspectives)) {
        $hasAnyPerspective = false;
        foreach ($selectedPerspectives as $p) {
            if (!empty($data['perspective_counts'][$p])) {
                $hasAnyPerspective = true;
                break;
            }
        }
        if (!$hasAnyPerspective) {
            $matches = false;
        }
    }

    // Category filter: employee's overall performance category must be in selection (OR logic)
    if ($matches && !empty($selectedCategories) && !in_array($data['performance_category'], $selectedCategories, true)) {
        $matches = false;
    }

    if ($matches) {
        $filteredEvaluations[$employeeId] = $data;
    }
}

// --- Aggregate metrics ONLY from filtered data ---
$performanceLabels = [
    'Needs Significant Improvement',
    'Developing',
    'Meets Expectations',
    'Exceeds Expectations',
    'Outstanding'
];
$performanceCounts = array_fill_keys($performanceLabels, 0);

$perspectiveLabels = [
    'Self-evaluation',
    'Supervisor',
    'Subordinate',
    'Colleague',
    'Other'
];
$perspectiveCounts = array_fill_keys($perspectiveLabels, 0);

$categoryMap = [
    'Job Knowledge and Technical Skills' => 'Job Knowledge',
    'Quality of Work' => 'Quality of Work',
    'Productivity and Efficiency' => 'Productivity',
    'Communication Skills' => 'Communication',
    'Teamwork and Collaboration' => 'Teamwork',
    'Problem-Solving and Initiative' => 'Problem-Solving',
    'Professionalism and Work Ethic' => 'Professionalism',
    'Adaptability and Continuous Improvement' => 'Adaptability'
];
$categoryAverages = array_fill_keys(array_keys($categoryMap), 0);
$categoryCounts   = array_fill_keys(array_keys($categoryMap), 0);

foreach ($filteredEvaluations as $data) {
    // performance buckets
    $performanceCounts[$data['performance_category']]++;

    // perspectives
    foreach ($data['perspective_counts'] as $perspective => $count) {
        if (isset($perspectiveCounts[$perspective])) {
            $perspectiveCounts[$perspective] += (int)$count;
        }
    }

    // category averages
    foreach ($data['category_scores'] as $category => $scoreData) {
        if (isset($categoryAverages[$category]) && $scoreData['count'] > 0) {
            $categoryAverages[$category] += (float)$scoreData['percentage'];
            $categoryCounts[$category]++;
        }
    }
}

foreach ($categoryAverages as $cat => $total) {
    $categoryAverages[$cat] = $categoryCounts[$cat] > 0 ? ($total / $categoryCounts[$cat]) : 0;
}

// Summary stats
$employeesEvaluatedCount = count($filteredEvaluations);
$avgScore = 'N/A';
if ($employeesEvaluatedCount > 0) {
    $sum = 0;
    foreach ($filteredEvaluations as $d) {
        $sum += (float)$d['weighted_score'];
    }
    $avgScore = round($sum / $employeesEvaluatedCount, 1) . '%';
}
$topPerformers = $performanceCounts['Exceeds Expectations'] + $performanceCounts['Outstanding'];
$needsImprovement = $performanceCounts['Needs Significant Improvement'] + $performanceCounts['Developing'];

// Build export query string
$exportQuery = build_query_string([
    'employee'    => $selectedEmployees,
    'perspective' => $selectedPerspectives,
    'category'    => $selectedCategories,
]);

require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ Performance Evaluation Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
        .card-dashboard {
            transition: transform .3s;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
            margin-bottom: 20px
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, .1)
        }

        .performance-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: .8rem;
            font-weight: 700
        }

        .bg-needs-improvement {
            background-color: #dc3545;
            color: #fff
        }

        .bg-developing {
            background-color: #fd7e14;
            color: #fff
        }

        .bg-meets-expectations {
            background-color: #ffc107;
            color: #000
        }

        .bg-exceeds-expectations {
            background-color: #20c997;
            color: #fff
        }

        .bg-outstanding {
            background-color: #198754;
            color: #fff
        }

        .sidebar {
            margin-top: 66px;
            background-color: #f8f9fa;
            height: 100vh;
            position: sticky;
            top: 0;
            padding-top: 20px
        }

        .main-content {
            padding: 20px
        }

        .evaluation-table th {
            background-color: #003366;
            color: #fff
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 30px
        }

        @media (max-width:768px) {
            .sidebar {
                height: auto;
                position: relative
            }

            .chart-container {
                height: 250px
            }
        }

        .mb-4 {
            margin-top: 55px !important;
            margin-bottom: 1.5rem !important
        }

        .filter-box {
            max-height: 220px;
            overflow: auto;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px;
            background: #fff
        }

        .filter-actions {
            display: flex;
            gap: .5rem;
            margin: 6px 0 12px 0
        }

        .legend-small {
            font-size: .9rem;
            color: #6c757d
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-md-block">
                <form method="get" action="dash.php">
                    <!-- Employee filter -->
                    <label class="form-label fw-bold">Employee</label>
                    <div class="filter-actions">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAll('employee',true)">Select all</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAll('employee',false)">Clear</button>
                    </div>
                    <div class="mb-3 filter-box" id="employeeBox">
                        <?php foreach ($employeesFromDB as $id => $employee): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="employee[]" value="<?= htmlspecialchars($id) ?>" id="emp_<?= htmlspecialchars($id) ?>" <?= in_array($id, $selectedEmployees, true) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="emp_<?= htmlspecialchars($id) ?>"><?= htmlspecialchars($employee['full_name']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Perspective filter -->
                    <label class="form-label fw-bold">Perspective</label>
                    <div class="filter-actions">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAll('perspective',true)">Select all</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAll('perspective',false)">Clear</button>
                    </div>
                    <div class="mb-3 filter-box" id="perspectiveBox">
                        <?php foreach ($perspectiveLabels as $p): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="perspective[]" value="<?= $p ?>" id="persp_<?= md5($p) ?>" <?= in_array($p, $selectedPerspectives, true) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="persp_<?= md5($p) ?>"><?= $p ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Category filter -->
                    <label class="form-label fw-bold">Performance Category</label>
                    <div class="filter-actions">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAll('category',true)">Select all</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAll('category',false)">Clear</button>
                    </div>
                    <div class="mb-3 filter-box" id="categoryBox">
                        <?php foreach ($performanceLabels as $c): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="<?= $c ?>" id="cat_<?= md5($c) ?>" <?= in_array($c, $selectedCategories, true) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="cat_<?= md5($c) ?>"><?= $c ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Apply Filters</button>
                    <a href="dash.php" class="btn btn-outline-secondary w-100">Reset Filters</a>
                    <hr>
                    <div class="d-grid gap-2">
                        <a href="export.php?type=excel&<?= htmlspecialchars($exportQuery) ?>" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export to Excel
                        </a>
                        <a href="export.php?type=pdf&<?= htmlspecialchars($exportQuery) ?>" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Export to PDF
                        </a>
                    </div>
                </form>
            </div>

            <!-- Main content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Performance Evaluation Dashboard</h2>
                    <span class="badge bg-primary"><?= (int)$employeesEvaluatedCount ?> Results</span>
                </div>

                <!-- Summary Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Employees Evaluated</h5>
                                <h2 class="card-text"><?= (int)$employeesEvaluatedCount ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title">Average Score</h5>
                                <h2 class="card-text"><?= htmlspecialchars($avgScore) ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Top Performers</h5>
                                <h2 class="card-text"><?= (int)$topPerformers ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Need Improvement</h5>
                                <h2 class="card-text"><?= (int)$needsImprovement ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card card-dashboard">
                            <div class="card-header">
                                <h5>Performance Distribution</h5>
                                <div class="legend-small">Percentages also shown in legend</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container"><canvas id="performanceChart"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-dashboard">
                            <div class="card-header">
                                <h5>Evaluation Perspectives</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-container"><canvas id="perspectiveChart"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card card-dashboard">
                            <div class="card-header">
                                <h5>Category Performance Averages</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-container"><canvas id="categoryChart"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employee Evaluations Table -->
                <div class="card card-dashboard mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Employee Evaluations</h5>
                        <span class="badge bg-secondary"><?= (int)$employeesEvaluatedCount ?> Result<?= $employeesEvaluatedCount === 1 ? '' : 's' ?></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover evaluation-table">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Evaluations</th>
                                        <th>Weighted Score</th>
                                        <th>Performance Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($filteredEvaluations)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No evaluations found with the selected filters.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($filteredEvaluations as $employeeId => $d): $employee = $d['details']; ?>
                                            <?php
                                            $safeEmp = htmlspecialchars(json_encode($employee, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
                                            $safePersp = htmlspecialchars(json_encode($d['perspective_counts'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
                                            $safeCats = htmlspecialchars(json_encode($d['category_scores'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
                                            $safeOverall = htmlspecialchars(json_encode([
                                                'weighted_score' => round($d['weighted_score'], 1),
                                                'performance_category' => $d['performance_category']
                                            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
                                            ?>
                                            <tr>
                                                <td>
                                                    <strong><?= htmlspecialchars($employee['full_name']) ?></strong><br>
                                                    <small class="text-muted"><?= htmlspecialchars($employee['position_title']) ?></small>
                                                </td>
                                                <td>
                                                    <?php foreach ($d['perspective_counts'] as $p => $count): if ($count > 0): ?>
                                                            <span class="badge bg-light text-dark me-1"><?= htmlspecialchars($p) ?>: <?= (int)$count ?></span>
                                                    <?php endif;
                                                    endforeach; ?>
                                                </td>
                                                <td>
                                                    <div class="progress" style="height:20px;">
                                                        <div class="progress-bar 
                                                        <?= $d['weighted_score'] < 30 ? 'bg-needs-improvement' : '' ?>
                                                        <?= $d['weighted_score'] >= 30 && $d['weighted_score'] < 61 ? 'bg-developing' : '' ?>
                                                        <?= $d['weighted_score'] >= 61 && $d['weighted_score'] < 76 ? 'bg-meets-expectations' : '' ?>
                                                        <?= $d['weighted_score'] >= 76 && $d['weighted_score'] <= 90 ? 'bg-exceeds-expectations' : '' ?>
                                                        <?= $d['weighted_score'] > 90 ? 'bg-outstanding' : '' ?>"
                                                            style="width: <?= (float)$d['weighted_score'] ?>%">
                                                            <?= round($d['weighted_score'], 1) ?>%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="performance-badge 
                                                    <?= $d['performance_category'] === 'Needs Significant Improvement' ? 'bg-needs-improvement' : '' ?>
                                                    <?= $d['performance_category'] === 'Developing' ? 'bg-developing' : '' ?>
                                                    <?= $d['performance_category'] === 'Meets Expectations' ? 'bg-meets-expectations' : '' ?>
                                                    <?= $d['performance_category'] === 'Exceeds Expectations' ? 'bg-exceeds-expectations' : '' ?>
                                                    <?= $d['performance_category'] === 'Outstanding' ? 'bg-outstanding' : '' ?>">
                                                        <?= htmlspecialchars($d['performance_category']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info"
                                                        data-emp='<?= $safeEmp ?>'
                                                        data-persp='<?= $safePersp ?>'
                                                        data-cats='<?= $safeCats ?>'
                                                        data-overall='<?= $safeOverall ?>'
                                                        onclick="showEmployeeDetails(this)">
                                                        <i class="bi bi-eye"></i> View
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Details Modal -->
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="employeeModalBody">Loading...</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>
    <br></br>

    <?php require_once 'footer.php'; ?>

    <script>
        // --- Filter helpers (Select all / Clear) ---
        function toggleAll(group, checked) {
            const containerId = group + "Box";
            const box = document.getElementById(containerId);
            if (!box) return;
            box.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = !!checked);
        }

        // --- Employee Details & Evaluator Fields (JS) ---
        function showEmployeeDetails(btn) {
            const emp = JSON.parse(btn.getAttribute('data-emp'));
            const persp = JSON.parse(btn.getAttribute('data-persp'));
            const cats = JSON.parse(btn.getAttribute('data-cats'));
            const overall = JSON.parse(btn.getAttribute('data-overall'));

            let perspHtml = '';
            Object.keys(persp).forEach(k => {
                if (persp[k] > 0) {
                    perspHtml += `<span class="badge bg-light text-dark me-1">${k}: ${persp[k]}</span>`;
                }
            });

            // category details table
            let catRows = '';
            for (const [longName, obj] of Object.entries(cats)) {
                const label = {
                    'Job Knowledge and Technical Skills': 'Job Knowledge',
                    'Quality of Work': 'Quality of Work',
                    'Productivity and Efficiency': 'Productivity',
                    'Communication Skills': 'Communication',
                    'Teamwork and Collaboration': 'Teamwork',
                    'Problem-Solving and Initiative': 'Problem-Solving',
                    'Professionalism and Work Ethic': 'Professionalism',
                    'Adaptability and Continuous Improvement': 'Adaptability'
                } [longName] || longName;
                const pct = obj && obj.percentage != null ? Number(obj.percentage).toFixed(1) : '0.0';
                const cnt = obj && obj.count != null ? Number(obj.count) : 0;
                catRows += `<tr><td>${label}</td><td>${pct}%</td><td>${cnt}</td></tr>`;
            }

            const html = `
        <div class="row g-3">
            <div class="col-md-6">
                <div class="border rounded p-3 bg-light">
                    <h6 class="mb-2">Profile</h6>
                    <p class="mb-1"><strong>Name:</strong> ${emp.full_name||''}</p>
                    <p class="mb-1"><strong>Position:</strong> ${emp.position_title||''}</p>
                    <p class="mb-0"><strong>Department:</strong> ${emp.department||''}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3 bg-light">
                    <h6 class="mb-2">Overall</h6>
                    <p class="mb-1"><strong>Weighted Score:</strong> ${overall.weighted_score}%</p>
                    <p class="mb-0"><strong>Category:</strong> ${overall.performance_category}</p>
                </div>
            </div>
            <div class="col-12">
                <div class="border rounded p-3">
                    <h6 class="mb-2">Evaluator Breakdown</h6>
                    ${perspHtml || '<span class="text-muted">No evaluators.</span>'}
                </div>
            </div>
            <div class="col-12">
                <div class="border rounded p-3">
                    <h6 class="mb-3">Category Scores</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead><tr><th>Category</th><th>Avg %</th><th>Responses</th></tr></thead>
                            <tbody>${catRows}</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>`;

            document.getElementById('employeeModalBody').innerHTML = html;
            new bootstrap.Modal(document.getElementById('employeeModal')).show();
        }

        // --- Chart.js with always-visible labels and no-data placeholders ---
        Chart.register(ChartDataLabels);

        // No-data plugin draws a centered message when all datapoints are zero/empty
        const NoDataPlugin = {
            id: 'noData',
            afterDraw(chart, args, opts) {
                const datasets = chart.data && chart.data.datasets ? chart.data.datasets : [];
                let hasData = false;
                for (const ds of datasets) {
                    if (Array.isArray(ds.data) && ds.data.some(v => (typeof v === 'number' ? v : 0) > 0)) {
                        hasData = true;
                        break;
                    }
                }
                if (!hasData) {
                    const {
                        ctx,
                        chartArea
                    } = chart;
                    if (!chartArea) return;
                    const {
                        left,
                        top,
                        width,
                        height
                    } = chartArea;
                    ctx.save();
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.font = '16px system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial';
                    ctx.fillStyle = (opts && opts.color) || '#6c757d';
                    ctx.fillText((opts && opts.text) || 'No data available for selected filters', left + width / 2, top + height / 2);
                    ctx.restore();
                }
            }
        };
        Chart.register(NoDataPlugin);

        // Data from PHP
        const perfLabels = <?= json_encode($performanceLabels) ?>;
        const perfData = <?= json_encode(array_values($performanceCounts), JSON_NUMERIC_CHECK) ?>;
        const perspLabels = <?= json_encode($perspectiveLabels) ?>;
        const perspData = <?= json_encode(array_values($perspectiveCounts), JSON_NUMERIC_CHECK) ?>;
        const catLongLabels = <?= json_encode(array_keys($categoryMap)) ?>;
        const catShortLabels = <?= json_encode(array_values($categoryMap)) ?>;
        const catData = <?= json_encode(array_map(fn($v) => round($v, 1), $categoryAverages), JSON_NUMERIC_CHECK) ?>;

        // Utility: compute % formatter for pie
        function percentFormatter(value, context) {
            const data = context.chart.data.datasets[0].data;
            const total = data.reduce((a, b) => a + (typeof b === 'number' ? b : 0), 0);
            if (!total || !value) return '';
            return (value * 100 / total).toFixed(1) + '%';
        }

        // Performance Pie Chart
        new Chart(document.getElementById('performanceChart'), {
            type: 'pie',
            data: {
                labels: perfLabels,
                datasets: [{
                    data: perfData,
                    backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#20c997', '#198754']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    noData: {
                        text: 'No data available for selected filters'
                    },
                    datalabels: {
                        color: '#fff',
                        formatter: (v, c) => percentFormatter(v, c),
                        display: (ctx) => {
                            // show label only if has data
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + (typeof b === 'number' ? b : 0), 0);
                            return total > 0 && ctx.raw > 0;
                        }
                    },
                    legend: {
                        position: 'right',
                        labels: {
                            generateLabels(chart) {
                                const data = chart.data;
                                const values = data.datasets[0].data;
                                const colors = data.datasets[0].backgroundColor || [];
                                const total = values.reduce((a, b) => a + (typeof b === 'number' ? b : 0), 0);
                                return data.labels.map((label, i) => {
                                    const v = typeof values[i] === 'number' ? values[i] : 0;
                                    const pct = total ? ((v * 100 / total).toFixed(1) + '%') : '0.0%';
                                    return {
                                        text: `${label} (${pct}, ${v})`,
                                        fillStyle: colors[i] || '#ccc',
                                        strokeStyle: '#fff',
                                        hidden: !chart.getDataVisibility(i),
                                        index: i
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });

        // Perspective Bar Chart
        new Chart(document.getElementById('perspectiveChart'), {
            type: 'bar',
            data: {
                labels: perspLabels,
                datasets: [{
                    label: 'Number of Evaluations per Perspective',
                    data: perspData,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    noData: {
                        text: 'No data available for selected filters'
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: (v) => v > 0 ? v : ''
                    },
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Category Average Bar Chart
        new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: {
                labels: catShortLabels,
                datasets: [{
                    label: 'Average Score (%)',
                    data: catLongLabels.map((k) => catData[k] ?? 0), // ensure order by long keys
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)', 'rgba(75, 192, 192, 0.7)', 'rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)',
                        'rgba(255, 205, 86, 0.7)', 'rgba(201, 203, 207, 0.7)', 'rgba(255, 99, 132, 0.7)', 'rgba(0, 128, 0, 0.7)'
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)', 'rgb(201, 203, 207)', 'rgb(255, 99, 132)', 'rgb(0, 128, 0)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: (v) => v + '%'
                        }
                    }
                },
                plugins: {
                    noData: {
                        text: 'No data available for selected filters'
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: (v) => (v && Number(v) > 0) ? (Number(v).toFixed(1) + '%') : ''
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>