<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERQ M&E System</title>
    <meta name="description" content="Welcome to MERQ M&E System Dashboard, Data Exploration and Administration System">
    <meta name="keywords"
        content="Monitoring, Evaluation, MERQ, Reporting, Dashboard, Data, Data Management, Exploration, Portal, MIKEINTOSH, Systems, System, MERQ Consultancy">
    <meta name="author" content="MERQ Consultancy">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://img.icons8.com/color/96/000000/data-configuration.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://img.icons8.com/color/96/000000/data-configuration.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://img.icons8.com/color/96/000000/data-configuration.png">

    <style>
        /* CSS Variables for Light/Dark Mode */
        :root {
            --primary-color: #002447;
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

            --header-height: 70px;
        }

        /* Dark Mode Variables */
        [data-theme="dark"] {
            --primary-color: #4dabf7;
            --primary-dark: #339af0;
            --primary-light: #1c7ed6;
            --secondary-color: #20c997;
            --accent-color: #ff6b8b;

            /**--bg-color: #121212;*/
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

        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: var(--header-height);
        }

        body {
            font-family: 'Inter', 'Roboto', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--bg-color);
            transition: var(--transition);
            min-height: 100vh;
            overflow-x: hidden;
            margin: 0;
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: var(--text-color);
        }

        h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
        }

        h2 {
            font-size: clamp(2rem, 4vw, 2.5rem);
        }

        h3 {
            font-size: clamp(1.5rem, 3vw, 1.8rem);
        }

        h4 {
            font-size: 1.25rem;
        }

        p {
            margin-bottom: 1rem;
            color: var(--text-secondary);
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        a:hover {
            color: var(--primary-dark);
        }

        /* Preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, #FFFFFF 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loader-container {
            position: fixed;
            top: 90px;
            text-align: center;
            padding: 2rem;
            border-radius: var(--border-radius-xl);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .merq-loader {
            font-size: 3.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
            position: relative;
        }

        .merq-loader::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #00bcd4, #ff4081, #4caf50);
            animation: loading 2s ease-in-out infinite;
            border-radius: 2px;
        }

        .loader-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes loading {

            0%,
            100% {
                transform: scaleX(0.3);
                opacity: 0.5;
            }

            50% {
                transform: scaleX(1);
                opacity: 1;
            }
        }

        body.loaded #preloader {
            opacity: 0;
            visibility: hidden;
        }

        /* Header & Navigation */
        header {
            background: var(--bg-color);
            box-shadow: var(--shadow-md);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            background: rgba(var(--bg-color-rgb), 0.95);
            height: var(--header-height);
            transition: var(--transition);
            border-bottom: 1px solid var(--border-color);
        }

        .tabs-section {
            background-color: #f9f9f9;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
            box-shadow: var(--shadow-md);
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-color);
        }

        .logo-text span {
            color: var(--primary-color);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Section Styles */
        .section {
            padding: 5rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
            padding-left: 343px;
        }

        .section-title::after {
            content: '';
            position: relative;
            bottom: -10px;
            left: 64%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .section-subtitle {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        /* Badge Styles */
        .badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        /* Highlight Box */
        .highlight-box {
            background: linear-gradient(135deg, var(--primary-light), var(--bg-color));
            border-radius: var(--border-radius-lg);
            padding: 3rem;
            margin: 3rem 0;
            border-left: 4px solid var(--primary-color);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Tab styling */
        .nav-tabs {
            margin-bottom: 2px;
            /*border-bottom: 1px solid var(--primary-color);*/
            border-bottom: 1px solid #e9e9e9;
        }

        .nav-link {
            color: var(--text-color);
            font-weight: 600;
            transition: var(--transition);
            border: none !important;
            border-radius: 8px 8px 0 0;
            padding: 12px 20px;
            margin: 0 5px;
            position: relative;
            overflow: hidden;
            background: var(--bg-secondary);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--primary-color);
            transition: var(--transition);
        }

        .nav-link.active {
            background-color: var(--primary-color) !important;
            color: white !important;
        }

        .nav-link.active::before {
            width: 100%;
        }

        .nav-link:not(.active):hover {
            color: var(--primary-color);
            background-color: rgba(0, 31, 63, 0.1);
        }

        .nav-link:not(.active):hover::before {
            width: 100%;
            background: var(--secondary-color);
        }

        .tab-content {
            padding: 1px;
            background: var(--bg-color);
            /*background: transparent;*/
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            /*border: 1px solid var(--border-color);*/
        }

        .components {
            padding: 7px 0;
            background: transparent;
        }

        /* FIXED STYLES */
        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        #tabsContent {
            height: calc(100% - 60px);
        }

        .tab-pane {
            height: 100%;
        }

        #embed {
            padding: 0 !important;
        }

        .dashboard-container {
            height: 100%;
            width: 100%;
            position: relative;
        }

        .dashboard-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            overflow: hidden;
        }

        .help-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            overflow: hidden;
        }

        /* Component tabs styling */
        .component-tabs .nav-link {
            color: var(--text-color);
            border-radius: 20px;
            margin: 0 5px 15px;
            padding: 8px 20px;
            transition: var(--transition);
            background: var(--bg-secondary);
        }

        .component-tabs .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .component-tabs .nav-link:hover:not(.active) {
            background: rgba(0, 31, 63, 0.1);
        }

        /* Component items styling */
        .component-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            padding: 30px;
            border-radius: var(--border-radius);
            background: var(--bg-color);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            transform: translateY(0);
            border: 1px solid var(--border-color);
            cursor: pointer;
        }

        .component-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .component-icon {
            flex: 0 0 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: white;
            font-size: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .component-text h4 {
            color: var(--primary-color);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .component-text p {
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        /* Search box styling */
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

        /* Loading animation for iframes */
        .iframe-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--primary-color);
            font-size: 2rem;
        }

        .iframe-loading::after {
            content: '';
            animation: loadingDots 1.5s infinite;
        }

        @keyframes loadingDots {
            0% {
                content: '';
            }

            25% {
                content: '.';
            }

            50% {
                content: '..';
            }

            75% {
                content: '...';
            }

            100% {
                content: '';
            }
        }

        /* 3D Text Animation */
        .welcome-text-3d {
            display: inline-block;
            font-size: 2.5rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #00A7CD;
            text-shadow:
                0 1px 0 #ccc,
                0 2px 0 #c9c9c9,
                0 3px 0 #bbb,
                0 4px 0 #b9b9b9,
                0 5px 0 #aaa,
                0 6px 1px rgba(0, 0, 0, .1),
                0 0 5px rgba(0, 0, 0, .1),
                0 1px 3px rgba(0, 0, 0, .3),
                0 3px 5px rgba(0, 0, 0, .2),
                0 5px 10px rgba(0, 0, 0, .25),
                0 10px 10px rgba(0, 0, 0, .2),
                0 20px 20px rgba(0, 0, 0, .15);
            animation: bounceIn 1.5s ease forwards;
            opacity: 0;
            transform: translateY(-30px);
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: translateY(-30px) scale(0.3);
            }

            50% {
                opacity: 1;
                transform: translateY(0) scale(1.05);
            }

            70% {
                transform: translateY(0) scale(0.9);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* M&E System text animation */
        .me-system-text {
            display: inline-block;
            margin-top: 10px;
        }

        .m-letter,
        .e-letter,
        .ampersand,
        .system-text {
            display: inline-block;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .m-letter {
            color: #00A7CD;
            animation-delay: 1.2s;
            text-shadow: 0 2px 10px rgba(0, 92, 125, 0.5);
        }

        .ampersand {
            color: #0086A4;
            animation-delay: 1.5s;
            text-shadow: 0 2px 10px rgba(213, 247, 255, 0.5);
        }

        .e-letter {
            color: #00A7CD;
            animation-delay: 1.8s;
            text-shadow: 0 2px 10px rgba(255, 209, 102, 0.5);
        }

        .system-text {
            color: #0077C2;
            animation-delay: 2.1s;
            text-shadow: 0 2px 10px rgba(250, 255, 175, 0.5);
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

        /* Theme Toggle */
        .theme-toggle-container {
            position: relative;
            margin-left: 1rem;
        }

        .theme-toggle {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            cursor: pointer;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: var(--transition);
        }

        .theme-toggle:hover {
            background: var(--bg-tertiary);
            transform: rotate(15deg);
            box-shadow: var(--shadow-md);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-tabs .nav-item {
                margin-bottom: 10px;
                width: 100%;
            }

            .nav-link {
                border-radius: var(--border-radius);
                text-align: center;
            }

            .component-item {
                flex-direction: column;
                text-align: center;
            }

            .component-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .component-tabs .nav-link {
                margin-bottom: 10px;
            }

            .tab-content {
                padding: 15px;
            }

            .welcome-text-3d {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body data-theme="light">
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader-container">
            <div class="merq-loader">MERQ M&E PORTAL</div>
            <div class="loader-subtitle">Loading Comprehensive Monitoring & Evaluation System</div>
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Tab Section -->
    <section class="tabs-section">
        <ul class="nav nav-tabs justify-content-center" id="tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                    <i class="fas fa-info-circle"></i> System Overview
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="embed-tab" data-bs-toggle="tab" data-bs-target="#embed" type="button" role="tab">
                    <i class="fas fa-chart-line"></i> Analytics Dashboard
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="help-tab" data-bs-toggle="tab" data-bs-target="#help" type="button" role="tab">
                    <i class="fas fa-question-circle"></i> Help & Support
                </button>
            </li>
            <li class="nav-item theme-toggle-container">
                <button class="theme-toggle" id="themeToggle" title="Toggle Dark/Light Mode">
                    <i class="fas fa-moon"></i>
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="tabsContent">
            <!-- Info Tab -->
            <div class="tab-pane fade show active" id="info" role="tabpanel">
                <!-- System Components Section -->
                <section class="components" id="components">
                    <div class="container">
                        <div class="section-title animate-fade-in" align="center">
                            <h2>
                                <div class="welcome-text-3d">
                                    Welcome to MERQ
                                </div>
                                <br>
                                <div class="me-system-text" style="font-size: 17px; font-weight: bold; margin-top: 20px;">
                                    <span class="m-letter">M</span>
                                    <span class="ampersand">&amp;</span>
                                    <span class="e-letter">E</span>
                                    <span class="system-text"> System</span>
                                </div>
                            </h2>
                            <p class="section-subtitle">A comprehensive Monitoring & Evaluation platform for tracking projects, opportunities, partnerships, and performance metrics. Authorized personnel only.</p>
                        </div>

                        <div class="search-box">
                            <input type="text" id="searchInput" placeholder="Search for system modules, features, or capabilities...">
                            <i class="fas fa-search"></i>
                        </div>

                        <ul class="nav nav-pills component-tabs justify-content-center" id="components-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="projects-tab" data-bs-toggle="pill" data-bs-target="#projects" type="button" role="tab">Projects Management</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="opportunities-tab" data-bs-toggle="pill" data-bs-target="#opportunities" type="button" role="tab">Business Development</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="partnerships-tab" data-bs-toggle="pill" data-bs-target="#partnerships" type="button" role="tab">Partnerships</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="admin-tab" data-bs-toggle="pill" data-bs-target="#admin" type="button" role="tab">Administration</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="components-tabContent">
                            <div class="tab-pane fade show active" id="projects" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="component-item animate-on-scroll" data-link="/app/mne_projects_list.php" style="animation-delay: 0.1s;">
                                            <div class="component-icon">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Projects Portfolio</h4>
                                                <p>Complete lifecycle management from initiation to completion. Track timelines, budgets, deliverables, and team allocations.</p>
                                            </div>
                                        </div>
                                        <div class="component-item animate-on-scroll" data-href="/app/mne_project_deliverables_list.php" style="animation-delay: 0.2s;">
                                            <div class="component-icon">
                                                <i class="fas fa-tasks"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Project Deliverables</h4>
                                                <p>Track deliverables with quality checks, milestones, and completion status across all active projects.</p>
                                            </div>
                                        </div>
                                        <div class="component-item animate-on-scroll" data-href="/app/mne_project_teams_list.php" style="animation-delay: 0.3s;">
                                            <div class="component-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Project Teams</h4>
                                                <p>Manage team allocations, roles, responsibilities, and performance tracking for project resources.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="component-item animate-on-scroll" data-href="/app/mne_project_risks_list.php" style="animation-delay: 0.4s;">
                                            <div class="component-icon">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Risk Management</h4>
                                                <p>Identify, assess, and mitigate project risks with comprehensive tracking and resolution workflows.</p>
                                            </div>
                                        </div>
                                        <div class="component-item animate-on-scroll" data-href="/app/mne_project_budget_list.php" style="animation-delay: 0.5s;">
                                            <div class="component-icon">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Budget Tracking</h4>
                                                <p>Monitor budget utilization, expenses, and financial performance across all projects with multi-currency support.</p>
                                            </div>
                                        </div>
                                        <div class="component-item animate-on-scroll" data-href="/app/mne_project_reports_list.php" style="animation-delay: 0.6s;">
                                            <div class="component-icon">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Project Reports</h4>
                                                <p>Generate comprehensive project status reports, progress updates, and performance analytics.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="opportunities" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="component-item" data-href="/app/mne_business_opportunities_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-lightbulb"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Business Opportunities</h4>
                                                <p>Track potential projects, RFPs, and tenders with pipeline analytics and win probability assessment.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/mne_proposals_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-file-contract"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Proposal Management</h4>
                                                <p>Manage proposal development, submission tracking, and outcome analysis with document version control.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/mne_win_loss_analysis_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Win/Loss Analysis</h4>
                                                <p>Analyze proposal outcomes to identify trends, improve win rates, and refine business development strategies.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="component-item" data-href="/app/mne_market_intelligence_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-search-dollar"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Market Intelligence</h4>
                                                <p>Collect and analyze market data, competitor information, and industry trends for strategic planning.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/mne_client_engagement_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Client Engagement</h4>
                                                <p>Track client interactions, relationship development, and engagement strategies for key accounts.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/mne_business_development_reports_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-chart-network"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>BD Reports & Analytics</h4>
                                                <p>Generate business development performance reports, pipeline forecasts, and opportunity analysis.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="partnerships" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="component-item" data-href="/app/mne_partnerships_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Partnership Management</h4>
                                                <p>Manage strategic partnerships, track MOUs, and monitor engagement levels with partner organizations.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/mne_partner_agreements_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-file-signature"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Partner Agreements</h4>
                                                <p>Track partnership agreements, renewals, compliance, and performance against contractual obligations.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/mne_joint_opportunities_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-project-diagram"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Joint Opportunities</h4>
                                                <p>Collaborate on joint proposals and projects with partner organizations, tracking shared responsibilities.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="component-item" data-href="/app/mne_partner_performance_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Partner Performance</h4>
                                                <p>Evaluate partner contributions, track deliverables, and assess partnership value and effectiveness.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/mne_stakeholder_engagement_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Stakeholder Engagement</h4>
                                                <p>Manage relationships with key stakeholders, track communications, and monitor engagement levels.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/mne_partnership_reports_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Partnership Reports</h4>
                                                <p>Generate comprehensive reports on partnership activities, outcomes, and strategic value.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="admin" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="component-item" data-href="/app/admin_rights_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Roles & Access Management</h4>
                                                <p>Granular control over user permissions, role-based access, and system security configurations.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/system_configuration_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>System Configuration</h4>
                                                <p>Centralized settings for system behavior, notifications, integrations, and organizational preferences.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/data_backup_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-database"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Data Backup & Recovery</h4>
                                                <p>Manage scheduled backups, recovery points, and data protection policies for system integrity.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="component-item" data-href="/app/report_templates_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Report Templates</h4>
                                                <p>Design and manage standard and custom report templates for consistent organizational reporting.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/integration_settings_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-exchange-alt"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Integration Settings</h4>
                                                <p>Configure external system integrations, API connections, and data synchronization settings.</p>
                                            </div>
                                        </div>
                                        <div class="component-item" data-href="/app/audit_logs_list.php">
                                            <div class="component-icon">
                                                <i class="fas fa-history"></i>
                                            </div>
                                            <div class="component-text">
                                                <h4>Audit & Activity Logs</h4>
                                                <p>Monitor system activities, track user actions, and maintain comprehensive audit trails for compliance.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Embed Tab -->
            <div class="tab-pane fade" id="embed" role="tabpanel">
                <div class="dashboard-container">
                    <div class="iframe-loading">Loading Analytics Dashboard</div>
                    <iframe
                        src="/meta/index.php"
                        class="dashboard-iframe"
                        allowtransparency="true"
                        allowfullscreen
                        onload="document.querySelector('.iframe-loading').style.display = 'none';">
                    </iframe>
                </div>
            </div>

            <!-- Help Tab -->
            <div class="tab-pane fade" id="help" role="tabpanel">
                <div class="dashboard-container">
                    <div class="iframe-loading">Loading Help System</div>
                    <iframe
                        src="help.php"
                        class="help-iframe"
                        allowtransparency="true"
                        onload="document.querySelectorAll('.iframe-loading')[1].style.display = 'none';">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            document.body.classList.add('loaded');

            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);

            // Initialize theme from cookie or system preference
            initializeTheme();
        });

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

        // Calculate available height for iframe
        function calculateAvailableHeight() {
            const tabsHeight = document.getElementById('tabs').offsetHeight;
            const windowHeight = window.innerHeight;
            return windowHeight - tabsHeight;
        }

        // Set initial height for tabsContent
        document.getElementById('tabsContent').style.height = calculateAvailableHeight() + 'px';

        // Adjust height on window resize
        window.addEventListener('resize', function() {
            document.getElementById('tabsContent').style.height = calculateAvailableHeight() + 'px';
        });

        // Handle tab switching
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', function() {
                // Force resize after tab switch
                document.getElementById('tabsContent').style.height = calculateAvailableHeight() + 'px';

                // Show loading indicator for iframe tabs
                if (this.id === 'embed-tab' || this.id === 'help-tab') {
                    const iframeContainers = document.querySelectorAll('.dashboard-container');
                    iframeContainers.forEach(container => {
                        const loadingIndicator = container.querySelector('.iframe-loading');
                        if (loadingIndicator) {
                            loadingIndicator.style.display = 'block';
                        }
                    });
                }
            });
        });

        // Add animation to component items when they become visible
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all component items
        document.querySelectorAll('.animate-on-scroll').forEach(item => {
            observer.observe(item);
        });

        // Search functionality for system modules
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const componentItems = document.querySelectorAll('.component-item');

                componentItems.forEach(item => {
                    const title = item.querySelector('h4').textContent.toLowerCase();
                    const description = item.querySelector('p').textContent.toLowerCase();

                    if (title.includes(filter) || description.includes(filter)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Add click handlers to component items
        document.addEventListener('DOMContentLoaded', function() {
            function openComponentWindow(url) {
                const windowFeatures = 'width=1700,height=800,scrollbars=yes,resizable=yes';
                window.open(url, '_blank', windowFeatures);
            }

            document.querySelectorAll('.component-item[data-href]').forEach(item => {
                item.addEventListener('click', function(e) {
                    const href = this.getAttribute('data-href');
                    if (href) {
                        openComponentWindow(href);
                    }
                });

                // Handle items with data-link attribute
                const linkAttr = this.getAttribute('data-link');
                if (linkAttr) {
                    item.addEventListener('click', function(e) {
                        openComponentWindow(linkAttr);
                    });
                }

                // Keyboard and accessibility support
                item.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        const href = this.getAttribute('data-href') || this.getAttribute('data-link');
                        if (href) {
                            openComponentWindow(href);
                        }
                    }
                });

                item.setAttribute('tabindex', '0');
                item.setAttribute('role', 'button');
                item.setAttribute('aria-label', `Open ${item.querySelector('h4').textContent}`);
            });
        });

        // Add hover effects to component tabs
        const componentTabs = document.querySelectorAll('.component-tabs .nav-link');
        componentTabs.forEach(tab => {
            tab.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'translateY(-2px)';
                }
            });

            tab.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });

        // Animation for 3D text
        document.addEventListener('DOMContentLoaded', function() {
            const welcomeText = document.querySelector('.welcome-text-3d');
            const meTextElements = document.querySelectorAll('.m-letter, .ampersand, .e-letter, .system-text');

            // Trigger animations
            setTimeout(() => {
                welcomeText.style.animation = 'bounceIn 1.5s ease forwards';
            }, 500);

            meTextElements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.animation = 'fadeInUp 0.8s ease forwards';
                }, 1200 + (index * 300));
            });
        });
    </script>
</body>

</html>