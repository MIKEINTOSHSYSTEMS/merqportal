<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ M&E Dashboard Help Guide</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS Variables for Light/Dark Mode */
        :root {
            --primary-color: #001f3f;
            --primary-dark: #0056b3;
            --primary-light: #e3f2fd;
            --secondary-color: #00bcd4;
            --accent-color: #ff4081;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
            --info-color: #2196f3;

            --bg-color: #ffffff;
            --bg-secondary: #f8f9fa;
            --bg-tertiary: #e9ecef;
            --text-color: #212529;
            --text-secondary: #6c757d;
            --border-color: #dee2e6;

            --gray-50: #f8f9fa;
            --gray-100: #f1f3f5;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;

            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

            --border-radius: 8px;
            --border-radius-lg: 12px;
            --border-radius-xl: 16px;

            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Dark Mode Variables */
        [data-theme="dark"] {
            --primary-color: #4dabf7;
            --primary-dark: #339af0;
            --primary-light: #1c7ed6;
            --secondary-color: #20c997;
            --accent-color: #ff6b8b;

            --bg-color: #121212;
            --bg-secondary: #1e1e1e;
            --bg-tertiary: #2d2d2d;
            --text-color: #e9ecef;
            --text-secondary: #adb5bd;
            --border-color: #495057;

            --gray-50: #212529;
            --gray-100: #343a40;
            --gray-200: #495057;
            --gray-300: #6c757d;
            --gray-400: #adb5bd;
            --gray-500: #ced4da;
            --gray-600: #e9ecef;
            --gray-700: #f1f3f5;
            --gray-800: #f8f9fa;
            --gray-900: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--bg-color);
            transition: var(--transition);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        header {
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: var(--border-radius-lg);
            margin-bottom: 30px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,224C672,235,768,181,864,160C960,139,1056,149,1152,165.3C1248,181,1344,203,1392,213.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            position: relative;
            animation: fadeInDown 1s ease;
        }

        header p {
            font-size: 1.2rem;
            opacity: 0.9;
            position: relative;
            animation: fadeInUp 1s ease;
        }

        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            cursor: pointer;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: var(--transition);
            z-index: 10;
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(15deg);
        }

        .search-box {
            max-width: 600px;
            margin: 20px auto;
            position: relative;
            animation: fadeIn 1.5s ease;
        }

        .search-box input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-size: 1rem;
            background: var(--bg-color);
            color: var(--text-color);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: var(--primary-color);
        }

        .search-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
            cursor: pointer;
        }

        .main-content {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
        }

        .sidebar {
            flex: 1;
            background: var(--bg-color);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 20px;
            height: fit-content;
            max-height: 80vh;
            overflow-y: auto;
            border: 1px solid var(--border-color);
        }

        .sidebar h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-light);
        }

        .content {
            flex: 3;
        }

        .section {
            background: var(--bg-color);
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            opacity: 0;
            transform: translateY(20px);
            border: 1px solid var(--border-color);
        }

        .section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .section:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .section h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-light);
            display: flex;
            align-items: center;
        }

        .section h2 i {
            margin-right: 10px;
            color: var(--secondary-color);
        }

        .filter-list {
            list-style: none;
            margin: 15px 0;
            cursor: pointer;
        }

        .filter-list li {
            padding: 10px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            transition: var(--transition);
            border-radius: var(--border-radius);
        }

        .filter-list li:hover {
            background: var(--primary-light);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .filter-list li:before {
            content: '•';
            color: var(--secondary-color);
            font-weight: bold;
            margin-right: 10px;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .chart-item {
            background: var(--bg-secondary);
            padding: 15px;
            border-radius: var(--border-radius);
            text-align: center;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .chart-item:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .tab-navigation {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-btn {
            padding: 10px 20px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            color: var(--text-color);
        }

        .tab-btn:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .tab-btn.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-color: transparent;
        }

        .export-options {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .export-btn {
            padding: 8px 15px;
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .export-btn.png {
            background: var(--danger-color);
            color: white;
        }

        .export-btn.csv {
            background: var(--success-color);
            color: white;
        }

        .export-btn.pdf {
            background: var(--info-color);
            color: white;
        }

        .export-btn.json {
            background: var(--warning-color);
            color: white;
        }

        .export-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            color: var(--text-secondary);
            border-top: 1px solid var(--border-color);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .sidebar {
                position: relative;
                top: 0;
            }

            header h1 {
                font-size: 2rem;
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }
        }

        .highlight {
            background-color: var(--primary-light);
            padding: 2px 5px;
            border-radius: 3px;
            font-weight: 500;
            color: var(--primary-color);
        }

        .note {
            background-color: var(--primary-light);
            padding: 15px;
            border-left: 4px solid var(--secondary-color);
            border-radius: var(--border-radius);
            margin: 15px 0;
        }

        .note p {
            margin: 0;
            color: var(--text-color);
        }

        .highlighted {
            animation: highlightPulse 2s ease;
        }

        @keyframes highlightPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 188, 212, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(0, 188, 212, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(0, 188, 212, 0);
            }
        }
    </style>
</head>

<body data-theme="light">
    <div class="container">
        <header>
            <button class="theme-toggle" id="themeToggle" title="Toggle Dark/Light Mode">
                <i class="fas fa-moon"></i>
            </button>
            <h1><i class="fas fa-life-ring"></i> MERQ M&E Dashboard Help Guide</h1>
            <small>Comprehensive System Documentation</small>
            <p>Your complete guide to using the MERQ Monitoring & Evaluation Dashboard</p>
        </header>

        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search for help articles...">
            <i class="fas fa-search"></i>
        </div>

        <div class="main-content">
            <div class="sidebar">
                <h2><i class="fas fa-list"></i> Table of Contents</h2>
                <ul class="filter-list">
                    <li data-section="overview">Dashboard Overview</li>
                    <li data-section="projects-tab">Projects Analytics Tab</li>
                    <li data-section="opportunities-tab">Opportunities Tab</li>
                    <li data-section="partnerships-tab">Partnerships Tab</li>
                    <li data-section="performance-tab">Performance Metrics Tab</li>
                    <li data-section="financial-tab">Financial Analytics Tab</li>
                    <li data-section="filters">Using Filters</li>
                    <li data-section="exporting">Exporting Data</li>
                    <li data-section="navigation">Dashboard Navigation</li>
                    <li data-section="security">Security & Access Control</li>
                </ul>
            </div>

            <div class="content">
                <div id="overview" class="section">
                    <h2><i class="fas fa-chart-line"></i> Dashboard Overview</h2>
                    <p>The MERQ M&E Dashboard provides a comprehensive overview of monitoring and evaluation data across all organizational activities. The dashboard is organized into several specialized tabs, each focusing on specific aspects of MERQ's operations.</p>

                    <div class="note">
                        <p><strong>Note:</strong> All data visualizations update dynamically based on your filter selections. Make sure to apply relevant filters to get the most accurate data for your needs.</p>
                    </div>

                    <p>Key features of the dashboard include:</p>
                    <ul class="filter-list">
                        <li>Interactive data visualizations with various chart types</li>
                        <li>Dynamic filtering options for customized data views</li>
                        <li>Multiple export options for each visualization</li>
                        <li>Tab-based organization for different data categories</li>
                        <li>Real-time data updates for live reporting</li>
                        <li>Role-based access control for data security</li>
                    </ul>
                </div>

                <div id="projects-tab" class="section">
                    <h2><i class="fas fa-briefcase"></i> Projects Analytics Tab</h2>
                    <p>The Projects Analytics tab provides comprehensive insights into project performance, timelines, and resource allocation across the organization.</p>

                    <h3>Available Filters:</h3>
                    <ul class="filter-list">
                        <li><span class="highlight">Project Status</span> - Filter by active, completed, or on-hold projects</li>
                        <li><span class="highlight">Project Type</span> - Select by project category or domain</li>
                        <li><span class="highlight">Country/Region</span> - Filter by geographical location</li>
                        <li><span class="highlight">Project Manager</span> - View projects by assigned manager</li>
                        <li><span class="highlight">Time Period</span> - Filter by start date, end date, or duration</li>
                        <li><span class="highlight">Budget Range</span> - Filter projects by budget size</li>
                        <li><span class="highlight">Risk Level</span> - View projects by assessed risk level</li>
                    </ul>

                    <h3>Charts & Visualizations:</h3>
                    <div class="chart-grid">
                        <div class="chart-item">Project Portfolio Overview</div>
                        <div class="chart-item">Timeline & Milestone Tracking</div>
                        <div class="chart-item">Budget vs Actual Comparison</div>
                        <div class="chart-item">Resource Allocation Heatmap</div>
                        <div class="chart-item">Risk Distribution Analysis</div>
                        <div class="chart-item">Deliverable Status Dashboard</div>
                    </div>
                </div>

                <div id="opportunities-tab" class="section">
                    <h2><i class="fas fa-lightbulb"></i> Opportunities Tab</h2>
                    <p>The Opportunities tab tracks the business development pipeline, proposal success rates, and market intelligence.</p>

                    <h3>Available Filters:</h3>
                    <ul class="filter-list">
                        <li><span class="highlight">Opportunity Status</span> - Filter by stage (identified, pursued, won, lost)</li>
                        <li><span class="highlight">Client Type</span> - Filter by client category</li>
                        <li><span class="highlight">Value Range</span> - Filter by estimated contract value</li>
                        <li><span class="highlight">Submission Date</span> - View by proposal submission timeline</li>
                        <li><span class="highlight">Win Probability</span> - Filter by estimated win chance</li>
                        <li><span class="highlight">Market Sector</span> - Filter by industry or sector</li>
                    </ul>

                    <h3>Charts & Visualizations:</h3>
                    <div class="chart-grid">
                        <div class="chart-item">Pipeline Value Chart</div>
                        <div class="chart-item">Win Rate Analysis</div>
                        <div class="chart-item">Opportunity Funnel</div>
                        <div class="chart-item">Market Segment Analysis</div>
                        <div class="chart-item">Proposal Development Timeline</div>
                        <div class="chart-item">Competitive Analysis</div>
                    </div>
                </div>

                <div id="partnerships-tab" class="section">
                    <h2><i class="fas fa-handshake"></i> Partnerships Tab</h2>
                    <p>This tab monitors strategic partnerships, collaboration effectiveness, and joint opportunity tracking.</p>

                    <h3>Available Filters:</h3>
                    <ul class="filter-list">
                        <li><span class="highlight">Partnership Type</span> - Strategic, technical, or implementing partners</li>
                        <li><span class="highlight">Engagement Level</span> - Filter by partnership engagement intensity</li>
                        <li><span class="highlight">Region/Country</span> - Geographical partnership distribution</li>
                        <li><span class="highlight">Agreement Status</span> - Active, expired, or under negotiation</li>
                        <li><span class="highlight">Performance Rating</span> - Filter by partnership performance score</li>
                        <li><span class="highlight">Duration</span> - Filter by partnership tenure</li>
                    </ul>

                    <h3>Key Visualizations:</h3>
                    <div class="chart-grid">
                        <div class="chart-item">Partnership Network Map</div>
                        <div class="chart-item">Engagement Level Dashboard</div>
                        <div class="chart-item">Joint Opportunity Tracker</div>
                        <div class="chart-item">Partnership Performance Scorecard</div>
                        <div class="chart-item">MOU/Agreement Status Board</div>
                        <div class="chart-item">Collaboration Effectiveness Chart</div>
                    </div>
                </div>

                <div id="performance-tab" class="section">
                    <h2><i class="fas fa-tachometer-alt"></i> Performance Metrics Tab</h2>
                    <p>The Performance Metrics tab tracks key performance indicators (KPIs) and organizational effectiveness measures.</p>

                    <h3>Available Filters:</h3>
                    <ul class="filter-list">
                        <li><span class="highlight">Metric Category</span> - Filter by type of performance metric</li>
                        <li><span class="highlight">Time Period</span> - Quarterly, monthly, or yearly performance</li>
                        <li><span class="highlight">Department/Team</span> - Filter by organizational unit</li>
                        <li><span class="highlight">Target vs Actual</span> - Compare performance against targets</li>
                        <li><span class="highlight">Trend Direction</span> - Improving, declining, or stable metrics</li>
                    </ul>

                    <h3>Key Visualizations:</h3>
                    <div class="chart-grid">
                        <div class="chart-item">KPI Dashboard</div>
                        <div class="chart-item">Trend Analysis Graphs</div>
                        <div class="chart-item">Target Achievement Charts</div>
                        <div class="chart-item">Benchmark Comparison</div>
                        <div class="chart-item">Performance Heat Maps</div>
                        <div class="chart-item">Progress Tracking Charts</div>
                    </div>

                    <div class="note">
                        <p><strong>Live Monitoring:</strong> All performance metrics update in real-time as data is entered into the system, providing current status information at all times.</p>
                    </div>
                </div>

                <div id="financial-tab" class="section">
                    <h2><i class="fas fa-chart-pie"></i> Financial Analytics Tab</h2>
                    <p>The Financial Analytics tab provides insights into budget utilization, revenue tracking, and financial performance across projects and departments.</p>

                    <h3>Available Filters:</h3>
                    <ul class="filter-list">
                        <li><span class="highlight">Account Type</span> - Revenue, expenses, or capital</li>
                        <li><span class="highlight">Currency</span> - Filter by currency type</li>
                        <li><span class="highlight">Fiscal Period</span> - Monthly, quarterly, or annual views</li>
                        <li><span class="highlight">Cost Center</span> - Filter by department or project</li>
                        <li><span class="highlight">Variance Threshold</span> - Show items exceeding budget variance limits</li>
                    </ul>

                    <h3>Visualizations:</h3>
                    <p>This tab includes multiple financial data visualizations with various dimensions, cost centers, and time periods tailored for financial analysis and reporting.</p>

                    <div class="chart-grid">
                        <div class="chart-item">Budget Utilization Dashboard</div>
                        <div class="chart-item">Revenue Tracking Charts</div>
                        <div class="chart-item">Expense Analysis Graphs</div>
                        <div class="chart-item">Financial Health Indicators</div>
                        <div class="chart-item">Multi-Currency Reports</div>
                        <div class="chart-item">Forecast vs Actual Comparison</div>
                    </div>
                </div>

                <div id="filters" class="section">
                    <h2><i class="fas fa-sliders-h"></i> Using Filters</h2>
                    <p>Filters allow you to customize the data displayed on the dashboard. Here's how to use them effectively:</p>

                    <h3>Filter Types:</h3>
                    <ul class="filter-list">
                        <li><span class="highlight">Single-select filters</span> - Choose one option from a dropdown</li>
                        <li><span class="highlight">Multi-select filters</span> - Select multiple options by checking boxes</li>
                        <li><span class="highlight">Date/Period filters</span> - Select specific time ranges</li>
                        <li><span class="highlight">Hierarchical filters</span> - Filters that change options based on previous selections</li>
                        <li><span class="highlight">Range filters</span> - Select values within a specified range</li>
                    </ul>

                    <h3>Tips for Effective Filtering:</h3>
                    <ul class="filter-list">
                        <li>Start with broader filters and gradually narrow down</li>
                        <li>Use the "Clear All" button to reset filters when needed</li>
                        <li>Remember that some filters are required (marked with *)</li>
                        <li>Apply filters consistently across tabs for comparable data</li>
                        <li>Save frequently used filter combinations as presets</li>
                        <li>Use the search function within filter dropdowns for quick selection</li>
                    </ul>
                </div>

                <div id="exporting" class="section">
                    <h2><i class="fas fa-download"></i> Exporting Data</h2>
                    <p>The dashboard provides multiple options for exporting data and visualizations to support reporting and analysis needs.</p>

                    <h3>Per-Chart Export Options:</h3>
                    <p>Each chart has export options available through a menu (typically represented by three dots or an export icon in the top-right corner).</p>

                    <div class="export-options">
                        <button class="export-btn png"><i class="fas fa-image"></i> PNG</button>
                        <button class="export-btn csv"><i class="fas fa-file-csv"></i> CSV</button>
                        <button class="export-btn pdf"><i class="fas fa-file-pdf"></i> PDF</button>
                        <button class="export-btn json"><i class="fas fa-code"></i> JSON</button>
                    </div>

                    <h3>Full Dashboard Export:</h3>
                    <p>You can export the entire tab as a PDF report using the "Export Full Dashboard" button available on each tab's toolbar.</p>

                    <h3>Scheduled Reports:</h3>
                    <p>Set up automated report delivery by configuring scheduled exports through the Report Templates module.</p>

                    <div class="note">
                        <p><strong>Best Practices:</strong> Use PNG exports for presentations and social media, CSV for data analysis in Excel, PDF for formal reports, and JSON for developers or data integration needs.</p>
                    </div>
                </div>

                <div id="navigation" class="section">
                    <h2><i class="fas fa-compass"></i> Dashboard Navigation</h2>
                    <p>Efficient navigation helps you make the most of the dashboard's capabilities and access the right information quickly.</p>

                    <h3>Tab Navigation:</h3>
                    <p>Use the tab menu to switch between different data categories and analytical perspectives:</p>
                    <div class="tab-navigation">
                        <button class="tab-btn">Projects Analytics</button>
                        <button class="tab-btn">Opportunities</button>
                        <button class="tab-btn">Partnerships</button>
                        <button class="tab-btn">Performance Metrics</button>
                        <button class="tab-btn">Financial Analytics</button>
                    </div>

                    <h3>Quick Access Features:</h3>
                    <ul class="filter-list">
                        <li><span class="highlight">Recent Views</span> - Quickly return to recently accessed dashboards</li>
                        <li><span class="highlight">Saved Filters</span> - Apply pre-configured filter sets with one click</li>
                        <li><span class="highlight">Bookmarks</span> - Save specific views for frequent access</li>
                        <li><span class="highlight">Dashboard Links</span> - Direct links to specific charts or views</li>
                    </ul>

                    <h3>Keyboard Shortcuts:</h3>
                    <ul class="filter-list">
                        <li>Use <span class="highlight">Ctrl + F</span> (or Cmd + F on Mac) to search within the current view</li>
                        <li>Press <span class="highlight">Esc</span> to close any open modals or filter panels</li>
                        <li>Use <span class="highlight">Tab</span> key to navigate between interactive elements</li>
                        <li><span class="highlight">Arrow keys</span> to navigate within data tables and grids</li>
                    </ul>
                </div>

                <div id="security" class="section">
                    <h2><i class="fas fa-shield-alt"></i> Security & Access Control</h2>
                    <p>The MERQ M&E Dashboard implements comprehensive security measures to protect sensitive organizational data.</p>

                    <h3>Access Control Features:</h3>
                    <ul class="filter-list">
                        <li><span class="highlight">Role-Based Access Control (RBAC)</span> - Different access levels for different user roles</li>
                        <li><span class="highlight">Data Segmentation</span> - Users only see data relevant to their role and permissions</li>
                        <li><span class="highlight">Activity Logging</span> - All user activities are logged for audit purposes</li>
                        <li><span class="highlight">Session Management</span> - Automatic session timeout for inactive users</li>
                        <li><span class="highlight">Encrypted Data</span> - All sensitive data is encrypted at rest and in transit</li>
                    </ul>

                    <h3>User Roles & Permissions:</h3>
                    <div class="chart-grid">
                        <div class="chart-item">Administrator - Full system access</div>
                        <div class="chart-item">Manager - Department/project level access</div>
                        <div class="chart-item">Analyst - Read-only data access</div>
                        <div class="chart-item">Viewer - Limited dashboard access</div>
                    </div>

                    <div class="note">
                        <p><strong>Security Note:</strong> All dashboard activities are monitored and logged. Unauthorized access attempts will trigger security alerts. If you notice any security concerns, please contact the system administrator immediately.</p>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <p>MERQ M&E Dashboard Help Guide | © <?php echo date('Y'); ?> MERQ Consultancy. All rights reserved. | Version 2.0.0</p>
            <p style="margin-top: 10px; font-size: 0.9rem; color: var(--text-secondary);">
                <i class="fas fa-lock"></i> Internal Use Only - Not for Public Distribution
            </p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme Toggle
            const themeToggle = document.getElementById('themeToggle');
            const body = document.body;

            function initializeTheme() {
                const savedTheme = localStorage.getItem('merq-theme') || 'light';
                const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = savedTheme === 'system' ? (systemPrefersDark ? 'dark' : 'light') : savedTheme;

                body.setAttribute('data-theme', theme);
                updateThemeIcon(theme);
            }

            function toggleTheme() {
                const currentTheme = body.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                body.setAttribute('data-theme', newTheme);
                localStorage.setItem('merq-theme', newTheme);
                updateThemeIcon(newTheme);
            }

            function updateThemeIcon(theme) {
                const icon = theme === 'dark' ? 'fa-sun' : 'fa-moon';
                themeToggle.innerHTML = `<i class="fas ${icon}"></i>`;
            }

            themeToggle.addEventListener('click', toggleTheme);
            initializeTheme();

            // Smooth scrolling for table of contents
            const tocItems = document.querySelectorAll('.filter-list li');
            tocItems.forEach(item => {
                item.addEventListener('click', function() {
                    const sectionId = this.getAttribute('data-section');
                    const section = document.getElementById(sectionId);

                    if (section) {
                        section.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                        // Add highlight effect
                        section.classList.add('highlighted');
                        setTimeout(() => {
                            section.classList.remove('highlighted');
                        }, 2000);
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const sections = document.querySelectorAll('.section');
                const tocItems = document.querySelectorAll('.filter-list li');

                let foundCount = 0;

                sections.forEach(section => {
                    const sectionText = section.textContent.toLowerCase();
                    const sectionId = section.id;

                    if (sectionText.includes(searchTerm)) {
                        section.style.display = 'block';
                        foundCount++;

                        // Highlight matching text
                        if (searchTerm.length >= 3) {
                            const regex = new RegExp(searchTerm, 'gi');
                            const content = section.innerHTML;
                            section.innerHTML = content.replace(regex, match =>
                                `<span class="highlight" style="background-color: var(--warning-color); color: white;">${match}</span>`
                            );
                        }
                    } else {
                        section.style.display = 'none';
                    }
                });

                // Update TOC highlighting
                tocItems.forEach(item => {
                    const sectionId = item.getAttribute('data-section');
                    const section = document.getElementById(sectionId);

                    if (section && section.style.display === 'block') {
                        item.style.fontWeight = '600';
                        item.style.color = 'var(--primary-color)';
                    } else {
                        item.style.fontWeight = 'normal';
                        item.style.color = '';
                    }
                });

                // Show message if no results
                const searchMessage = document.getElementById('searchMessage');
                if (!searchMessage && searchTerm.length >= 2) {
                    const message = document.createElement('div');
                    message.id = 'searchMessage';
                    message.style.cssText = 'text-align: center; padding: 20px; color: var(--text-secondary);';
                    message.textContent = foundCount === 0 ? 'No results found for "' + searchTerm + '"' : 'Found ' + foundCount + ' matching sections';

                    const contentDiv = document.querySelector('.content');
                    if (foundCount === 0) {
                        contentDiv.innerHTML = '';
                        contentDiv.appendChild(message);
                    } else if (!document.getElementById('searchMessage')) {
                        contentDiv.insertBefore(message, contentDiv.firstChild);
                    }
                } else if (searchTerm.length === 0 && searchMessage) {
                    searchMessage.remove();
                }
            });

            // Animation on scroll
            const sections = document.querySelectorAll('.section');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            sections.forEach(section => {
                observer.observe(section);
            });

            // Tab button interaction
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Scroll to corresponding section
                    const tabText = this.textContent.toLowerCase().replace(/\s+/g, '-');
                    const section = document.getElementById(tabText + '-tab');
                    if (section) {
                        section.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Handle URL fragments for direct section linking
            const urlFragment = window.location.hash.substring(1);
            if (urlFragment) {
                const targetSection = document.getElementById(urlFragment);
                if (targetSection) {
                    setTimeout(() => {
                        targetSection.scrollIntoView({
                            behavior: 'smooth'
                        });
                        targetSection.classList.add('highlighted');
                        setTimeout(() => {
                            targetSection.classList.remove('highlighted');
                        }, 2000);
                    }, 300);
                }
            }

            // Export button functionality
            const exportButtons = document.querySelectorAll('.export-btn');
            exportButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const format = this.classList[1]; // png, csv, pdf, json
                    alert('Exporting data in ' + format.toUpperCase() + ' format...\n\nNote: In the actual dashboard, this would trigger the export functionality for the current view.');
                });
            });

            // Auto-hide search message when typing starts
            searchInput.addEventListener('input', function() {
                const searchMessage = document.getElementById('searchMessage');
                if (searchMessage && this.value.length >= 2) {
                    searchMessage.style.display = 'block';
                }
            });

            // Add animation to chart items on hover
            const chartItems = document.querySelectorAll('.chart-item');
            chartItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });

                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
</body>

</html>