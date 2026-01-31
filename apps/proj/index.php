<?php
// Database connection
$host = 'localhost';
$dbname = 'merq_portal';
$username = 'merq_portal';
$password = 'merq_portal';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch dynamic statistics
    $stats = [];

    // Active projects count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM mne_projects WHERE is_active = 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stats['active_projects'] = $result ? $result['count'] : 0;

    // Total contract value
    $stmt = $pdo->query("SELECT SUM(total_value) as total FROM mne_projects WHERE is_active = 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stats['total_contract_value'] = $result && $result['total'] ? $result['total'] : 0;

    // Key indicators count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM mne_indicator_matrix WHERE is_active = 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stats['key_indicators'] = $result ? $result['count'] : 0;

    // Total opportunities
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM mne_business_opportunities WHERE is_active = 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stats['total_opportunities'] = $result ? $result['count'] : 0;

    // Active partnerships
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM mne_partnerships WHERE is_active = 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stats['active_partnerships'] = $result ? $result['count'] : 0;

    // Recent projects
    $stmt = $pdo->query("SELECT project_name, start_date, total_value FROM mne_projects WHERE is_active = 1 ORDER BY start_date DESC LIMIT 5");
    $stats['recent_projects'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Performance metrics - handle null values
    $stmt = $pdo->query("SELECT metric_name, ytd_value FROM mne_business_performance ORDER BY created_at DESC LIMIT 4");
    $performance_metrics = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ensure numeric values for performance metrics
    foreach ($performance_metrics as &$metric) {
        $metric['ytd_value'] = is_numeric($metric['ytd_value']) ? floatval($metric['ytd_value']) : 0.00;
    }
    $stats['performance_metrics'] = $performance_metrics;

    // Get some additional stats
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users WHERE is_active = 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stats['active_users'] = $result ? $result['count'] : 0;

    $stmt = $pdo->query("SELECT COUNT(*) as count FROM mne_project_deliverables");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stats['deliverables'] = $result ? $result['count'] : 0;
} catch (PDOException $e) {
    // Fallback to default stats if database connection fails
    $stats = [
        'active_projects' => 14,
        'total_contract_value' => 21000000,
        'key_indicators' => 25,
        'total_opportunities' => 50,
        'active_partnerships' => 15,
        'active_users' => 45,
        'deliverables' => 120,
        'recent_projects' => [],
        'performance_metrics' => [
            ['metric_name' => 'Project Win Rate', 'ytd_value' => 68.5],
            ['metric_name' => 'On-time Delivery', 'ytd_value' => 92.3],
            ['metric_name' => 'Client Satisfaction', 'ytd_value' => 94.7],
            ['metric_name' => 'Budget Adherence', 'ytd_value' => 88.2]
        ]
    ];
}

// Simple PHP configuration
$page_title = "MERQ M&E System - Comprehensive Monitoring & Evaluation Platform";
$current_year = date('Y');

// Format currency
function formatCurrency($value)
{
    if (is_numeric($value)) {
        $value = floatval($value);
        if ($value >= 1000000) {
            return '$' . number_format($value / 1000000, 1) . 'M';
        } elseif ($value >= 1000) {
            return '$' . number_format($value / 1000, 1) . 'K';
        } else {
            return '$' . number_format($value, 0);
        }
    }
    return '$0';
}

// Format percentage safely
function formatPercentage($value)
{
    if (is_numeric($value)) {
        return number_format(floatval($value), 2) . '%';
    }
    return '0.00%';
}

// Check if user has accepted terms
$terms_accepted = isset($_COOKIE['merq_terms_accepted']) && $_COOKIE['merq_terms_accepted'] === 'true';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://img.icons8.com/color/96/000000/data-configuration.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://img.icons8.com/color/96/000000/data-configuration.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://img.icons8.com/color/96/000000/data-configuration.png">

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

            --header-height: 70px;
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
            background: linear-gradient(135deg, var(--primary-color) 0%, #000814 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loader-container {
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

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            margin-left: auto;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            position: relative;
            padding: 0.5rem 0.75rem;
            opacity: 0.9;
            white-space: nowrap;
        }

        .nav-link:hover {
            opacity: 1;
            color: var(--primary-color);
        }

        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0.75rem;
            right: 0.75rem;
            height: 2px;
            background: var(--primary-color);
            border-radius: 1px;
        }

        .cta-button {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: var(--shadow-md);
            white-space: nowrap;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
        }

        /* Theme Toggle Button */
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

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-color);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            margin-left: 1rem;
        }

        .mobile-menu-btn:hover {
            background: var(--bg-secondary);
        }

        /* Mobile Menu - Sidebar */
        .mobile-menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -320px;
            width: 300px;
            height: 100%;
            background: var(--bg-color);
            box-shadow: var(--shadow-xl);
            z-index: 1000;
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .mobile-menu.active {
            right: 0;
        }

        .mobile-menu-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-secondary);
        }

        .mobile-menu-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .mobile-menu-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: var(--border-radius);
        }

        .mobile-menu-content {
            padding: 1.5rem;
            flex: 1;
        }

        .mobile-nav-link {
            display: block;
            padding: 1rem;
            color: var(--text-color);
            text-decoration: none;
            border-radius: var(--border-radius);
            margin-bottom: 0.5rem;
            transition: var(--transition);
            font-weight: 500;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            background: var(--bg-secondary);
            color: var(--primary-color);
        }

        .mobile-nav-link i {
            width: 24px;
            margin-right: 0.75rem;
        }

        .mobile-menu-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            background: var(--bg-secondary);
        }

        /* Hero Section */
        .hero {
            padding: calc(var(--header-height) + 2rem) 2rem 4rem;
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 70%;
            height: 150%;
            background: radial-gradient(circle, var(--primary-light) 0%, transparent 70%);
            opacity: 0.3;
            z-index: -1;
        }

        .hero h1 {
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto 3rem;
            line-height: 1.7;
            color: var(--text-secondary);
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
            padding: 0 1rem;
        }

        .stat-card {
            background: var(--bg-color);
            padding: 2rem;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* Search Box */
        .search-container {
            max-width: 600px;
            margin: 0 auto 4rem;
            position: relative;
            padding-top: 2rem;
        }

        .search-box {
            width: 100%;
            padding: 1rem 1.5rem;
            padding-left: 3.5rem;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-lg);
            font-size: 1rem;
            background: var(--bg-color);
            color: var(--text-color);
            transition: var(--transition);
        }

        .search-box:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 31, 63, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1.5rem;
            top: calc(50% + 1rem);
            transform: translateY(-50%);
            color: var(--text-secondary);
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
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
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

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: var(--bg-color);
            border-radius: var(--border-radius-lg);
            padding: 2.5rem 2rem;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-light), var(--bg-color));
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-size: 1.8rem;
            box-shadow: var(--shadow-md);
        }

        .feature-title {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .feature-description {
            line-height: 1.7;
            color: var(--text-secondary);
        }

        /* Dashboard Preview */
        .dashboard-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .metric-card {
            background: var(--bg-color);
            padding: 1.5rem;
            border-radius: var(--border-radius-lg);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .metric-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .metric-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .metric-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Modules Section */
        .modules-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .module-card {
            background: var(--bg-color);
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .module-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .module-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            transform: rotate(30deg);
        }

        .module-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .module-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .module-content {
            padding: 2rem;
        }

        .module-features {
            list-style: none;
        }

        .module-features li {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .module-features li:last-child {
            border-bottom: none;
        }

        .module-features li i {
            color: var(--success-color);
            font-size: 0.9rem;
        }

        /* Technology Stack */
        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .tech-item {
            background: var(--bg-color);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
            border: 1px solid var(--border-color);
            min-width: 180px;
        }

        .tech-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
        }

        .tech-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-light);
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        /* Footer - Dark theme by default */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 4rem 2rem 2rem;
            margin-top: 4rem;
            transition: var(--transition);
        }

        [data-theme="light"] footer {
            background: #2d2d2d;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-column h3 {
            color: white;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--secondary-color);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .footer-links a i {
            font-size: 0.8rem;
            width: 16px;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: var(--transition);
        }

        .social-link:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-info {
            color: #adb5bd;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-top: 1rem;
        }

        .copyright {
            text-align: center;
            padding-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #adb5bd;
            font-size: 0.9rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .developer-info {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            margin-top: 2rem;
            border-left: 4px solid var(--secondary-color);
        }

        .developer-info h4 {
            color: white;
            margin-bottom: 0.5rem;
        }

        /* Disclaimer and Privacy Modals */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            backdrop-filter: blur(5px);
            padding: 1rem;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: var(--bg-color);
            border-radius: var(--border-radius-xl);
            padding: 3rem;
            max-width: 800px;
            width: 100%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-color);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .modal-title {
            font-size: 1.8rem;
            color: var(--text-color);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger-color);
            background: var(--bg-secondary);
        }

        .modal-content {
            line-height: 1.8;
            color: var(--text-secondary);
        }

        .modal-content h3 {
            color: var(--text-color);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .modal-content ul {
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .modal-content li {
            margin-bottom: 0.5rem;
        }

        /* Terms Modal */
        .terms-modal {
            max-width: 1000px;
            max-height: 85vh;
        }

        .terms-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .btn-accept {
            background: linear-gradient(135deg, var(--success-color), #2e7d32);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-accept:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-decline {
            background: var(--bg-secondary);
            color: var(--text-color);
            padding: 0.75rem 2rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-decline:hover {
            background: var(--bg-tertiary);
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

        /* Testimonial */
        .testimonial {
            background: var(--bg-color);
            padding: 2.5rem;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            margin: 3rem auto;
            max-width: 800px;
            position: relative;
            border: 1px solid var(--border-color);
        }

        .testimonial::before {
            content: '"';
            font-size: 6rem;
            color: var(--primary-light);
            position: absolute;
            top: -20px;
            left: 20px;
            font-family: Georgia, serif;
            opacity: 0.5;
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

        /* Role Badges */
        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin: 0.25rem;
        }

        .role-admin {
            background: linear-gradient(135deg, #d32f2f, #f44336);
            color: white;
        }

        .role-manager {
            background: linear-gradient(135deg, #1976d2, #2196f3);
            color: white;
        }

        .role-employee {
            background: linear-gradient(135deg, #388e3c, #4caf50);
            color: white;
        }

        .role-consultant {
            background: linear-gradient(135deg, #f57c00, #ff9800);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .nav-container {
                padding: 0 1.5rem;
            }

            .hero {
                padding: calc(var(--header-height) + 1.5rem) 1.5rem 3rem;
            }

            .section {
                padding: 4rem 1.5rem;
            }

            .nav-links {
                gap: 1rem;
            }
        }

        @media (max-width: 992px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .theme-toggle-container {
                margin-left: 0;
            }

            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .features-grid,
            .modules-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .mobile-menu-overlay {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                padding: 0 1rem;
            }

            .hero {
                padding: calc(var(--header-height) + 1rem) 1rem 2rem;
            }

            .section {
                padding: 3rem 1rem;
            }

            .hero-stats,
            .features-grid,
            .modules-container {
                grid-template-columns: 1fr;
            }

            .modal {
                padding: 2rem;
                width: 95%;
            }

            .search-container {
                margin: 0 auto 2rem;
                padding-top: 1rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 576px) {
            .logo-text {
                font-size: 1.25rem;
            }

            .logo-icon {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .feature-card,
            .module-card {
                padding: 1.5rem;
            }

            .modal {
                padding: 1.5rem;
            }

            .terms-actions {
                flex-direction: column;
            }

            .btn-accept,
            .btn-decline {
                width: 100%;
                text-align: center;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .mobile-menu {
                width: 280px;
            }
        }

        /* Print Styles */
        @media print {
            .no-print {
                display: none;
            }

            body {
                background: white;
                color: black;
            }

            .modal-overlay {
                display: none;
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

    <!-- Terms Agreement Modal -->
    <div id="termsModal" class="modal-overlay <?php echo !$terms_accepted ? 'active' : ''; ?>">
        <div class="modal terms-modal">
            <div class="modal-header">
                <h2 class="modal-title">⚠️ Terms of Use & System Access Agreement</h2>
                <button class="modal-close" onclick="declineTerms()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-content">
                <div class="highlight-box">
                    <h3 style="color: var(--danger-color);"><i class="fas fa-exclamation-triangle"></i> IMPORTANT SECURITY NOTICE</h3>
                    <p>This system contains sensitive and confidential information. Unauthorized access, use, or disclosure is strictly prohibited and may result in legal action.</p>
                </div>

                <h3><i class="fas fa-shield-alt"></i> System Authorization & Access Control</h3>
                <p>The MERQ Monitoring & Evaluation System is a <strong>role-based, internally restricted platform</strong> designed exclusively for authorized personnel. This system is:</p>
                <ul>
                    <li><strong>NOT AVAILABLE TO THE PUBLIC</strong> - Access is strictly limited to authenticated users</li>
                    <li><strong>NOT FOR SALE OR DISTRIBUTION</strong> - This is proprietary software</li>
                    <li><strong>CONFIDENTIAL & SECURED</strong> - All data is encrypted and protected</li>
                    <li><strong>INTERNAL USE ONLY</strong> - For organizational monitoring and evaluation purposes</li>
                </ul>

                <h3><i class="fas fa-user-lock"></i> User Responsibilities & Compliance</h3>
                <p>By accessing this system, you agree to:</p>
                <ul>
                    <li>Use the system only for authorized business purposes</li>
                    <li>Maintain the confidentiality of all system information</li>
                    <li>Not share login credentials or access with unauthorized individuals</li>
                    <li>Comply with all organizational security policies and procedures</li>
                    <li>Report any security concerns or unauthorized access immediately</li>
                    <li>Accept that all activities are monitored and logged for security purposes</li>
                </ul>

                <h3><i class="fas fa-database"></i> Data Collection & Privacy</h3>
                <p>This system collects and processes the following information:</p>
                <ul>
                    <li><strong>User Activity:</strong> All system interactions, searches, and data access</li>
                    <li><strong>Session Information:</strong> Login times, IP addresses, and device information</li>
                    <li><strong>Usage Analytics:</strong> Feature utilization and system performance data</li>
                    <li><strong>Security Logs:</strong> Access attempts and system changes</li>
                </ul>
                <p>All data is stored securely and used exclusively for system security, performance improvement, and compliance purposes.</p>

                <h3><i class="fas fa-balance-scale"></i> Legal & Compliance Statements</h3>
                <ul>
                    <li>Unauthorized access violates computer fraud and abuse laws</li>
                    <li>System misuse may result in disciplinary action and legal proceedings</li>
                    <li>All data remains the property of the organization</li>
                    <li>Export or distribution of system data without authorization is prohibited</li>
                </ul>

                <div class="highlight-box">
                    <h3><i class="fas fa-check-circle"></i> Agreement Confirmation</h3>
                    <p>By clicking "I Accept", you confirm that you are an authorized user, have read and understood these terms, and agree to comply with all system policies and procedures.</p>
                </div>

                <div class="terms-actions">
                    <button class="btn-decline" onclick="declineTerms()">
                        <i class="fas fa-times"></i> I Decline
                    </button>
                    <button class="btn-accept" onclick="acceptTerms()">
                        <i class="fas fa-check"></i> I Accept & Continue
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div id="privacyModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title"><i class="fas fa-user-shield"></i> Privacy & Data Protection Policy</h2>
                <button class="modal-close" onclick="closeModal('privacyModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-content">
                <h3><i class="fas fa-lock"></i> Data Security & Protection</h3>
                <p>Your privacy and data security are our highest priority. We implement industry-standard security measures including:</p>
                <ul>
                    <li>End-to-end encryption for all sensitive data</li>
                    <li>Regular security audits and vulnerability assessments</li>
                    <li>Secure data storage with access controls</li>
                    <li>Comprehensive backup and disaster recovery systems</li>
                    <li>GDPR-compliant data protection measures</li>
                </ul>

                <h3><i class="fas fa-cookie-bite"></i> Cookies & Tracking Technologies</h3>
                <p>This system uses essential cookies for:</p>
                <ul>
                    <li><strong>Session Management:</strong> Maintaining secure login sessions</li>
                    <li><strong>Security:</strong> Preventing unauthorized access and CSRF attacks</li>
                    <li><strong>Preferences:</strong> Remembering user settings and theme choices</li>
                    <li><strong>Performance:</strong> Optimizing system response times</li>
                </ul>
                <p>No tracking cookies are used for advertising or third-party analytics.</p>

                <h3><i class="fas fa-database"></i> Data Retention & Access</h3>
                <ul>
                    <li>Activity logs are retained for 365 days for security auditing</li>
                    <li>User data is retained while accounts remain active</li>
                    <li>Data access is strictly role-based and need-to-know</li>
                    <li>Regular data purging of obsolete information</li>
                </ul>

                <h3><i class="fas fa-user-check"></i> Your Rights</h3>
                <p>As a user, you have the right to:</p>
                <ul>
                    <li>Access your personal data stored in the system</li>
                    <li>Request correction of inaccurate information</li>
                    <li>Request deletion of your data (subject to legal requirements)</li>
                    <li>Export your data in a machine-readable format</li>
                    <li>Withdraw consent for non-essential processing</li>
                </ul>

                <p style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                    <i class="fas fa-info-circle"></i> For privacy concerns or data requests, contact the system administrator at
                    <strong>privacy@merqconsultancy.org</strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Disclaimer Modal -->
    <div id="disclaimerModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title"><i class="fas fa-exclamation-circle"></i> System Disclaimer</h2>
                <button class="modal-close" onclick="closeModal('disclaimerModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-content">
                <div class="highlight-box">
                    <h3 style="color: var(--warning-color);"><i class="fas fa-exclamation-triangle"></i> IMPORTANT DISCLAIMER</h3>
                    <p>This system is provided for internal organizational use only. All information, data, and reports are confidential and proprietary.</p>
                </div>

                <h3><i class="fas fa-balance-scale"></i> Legal & Usage Disclaimer</h3>
                <ul>
                    <li>This system and its contents are NOT FOR PUBLIC DISTRIBUTION</li>
                    <li>Information is provided "as-is" without warranty of any kind</li>
                    <li>The organization reserves the right to modify or terminate access</li>
                    <li>Users are responsible for maintaining the confidentiality of their credentials</li>
                    <li>Unauthorized reproduction or distribution is strictly prohibited</li>
                </ul>

                <h3><i class="fas fa-chart-line"></i> Data Accuracy Disclaimer</h3>
                <ul>
                    <li>While we strive for accuracy, data may contain errors or omissions</li>
                    <li>Users should verify critical information independently</li>
                    <li>Historical data is maintained for reference only</li>
                    <li>System data should not be the sole basis for major decisions</li>
                </ul>

                <h3><i class="fas fa-network-wired"></i> System Availability</h3>
                <ul>
                    <li>System availability is not guaranteed 24/7</li>
                    <li>Scheduled maintenance may cause temporary unavailability</li>
                    <li>Data backup and recovery procedures are in place</li>
                    <li>Report any system issues immediately to IT support</li>
                </ul>

                <p style="margin-top: 2rem; font-style: italic; color: var(--text-secondary);">
                    <i class="fas fa-info-circle"></i> This disclaimer is subject to change. Users are responsible for reviewing updates.
                </p>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="nav-container">
            <a href="#home" class="logo">
                <div class="logo-icon">M&E</div>
                <div class="logo-text">MERQ <span>System</span></div>
            </a>

            <nav class="nav-links">
                <a href="#home" class="nav-link active"><i class="fas fa-home"></i> Home</a>
                <a href="#features" class="nav-link"><i class="fas fa-star"></i> Features</a>
                <a href="#modules" class="nav-link"><i class="fas fa-cubes"></i> Modules</a>
                <a href="#dashboard" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="#technology" class="nav-link"><i class="fas fa-code"></i> Technology</a>
                <a href="#roles" class="nav-link"><i class="fas fa-users-cog"></i> Roles</a>

                <div class="theme-toggle-container">
                    <button class="theme-toggle" id="themeToggle" title="Toggle Dark/Light Mode">
                        <i class="fas fa-moon"></i>
                    </button>
                </div>

                <a href="app/login.php" class="cta-button">
                    <i class="fas fa-sign-in-alt"></i> Access Dashboard
                </a>
            </nav>

            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Mobile Sidebar Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <h3 class="mobile-menu-title">Menu</h3>
            <button class="mobile-menu-close" id="mobileMenuClose">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mobile-menu-content">
            <a href="#home" class="mobile-nav-link active" onclick="closeMobileMenu()">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="#features" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-star"></i> Features
            </a>
            <a href="#modules" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-cubes"></i> Modules
            </a>
            <a href="#dashboard" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="#technology" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-code"></i> Technology
            </a>
            <a href="#roles" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-users-cog"></i> Roles
            </a>
            <a href="#" class="mobile-nav-link" onclick="openModal('privacyModal'); closeMobileMenu(); return false;">
                <i class="fas fa-shield-alt"></i> Privacy
            </a>
            <a href="#" class="mobile-nav-link" onclick="openModal('disclaimerModal'); closeMobileMenu(); return false;">
                <i class="fas fa-exclamation-circle"></i> Disclaimer
            </a>
        </div>

        <div class="mobile-menu-footer">
            <a href="app/login.php" class="cta-button" style="width: 100%; text-align: center; justify-content: center;">
                <i class="fas fa-sign-in-alt"></i> Access Dashboard
            </a>
            <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
                <span style="color: var(--text-secondary);">Theme:</span>
                <button class="theme-toggle" id="mobileThemeToggle" title="Toggle Dark/Light Mode" style="margin: 0;">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <h1>Comprehensive <span>Monitoring & Evaluation</span> Platform</h1>
        <p class="hero-subtitle">
            A <strong>secure, role-based internal system</strong> for tracking projects, opportunities, partnerships, and performance metrics.
            <strong>Not for public distribution or sale.</strong> Authorized personnel only.
        </p>

        <div class="hero-stats">
            <div class="stat-card animate-on-scroll">
                <span class="stat-number" id="activeProjects"><?php echo $stats['active_projects']; ?></span>
                <span class="stat-label">Active Projects</span>
                <small style="display: block; margin-top: 0.5rem; color: var(--text-secondary); font-size: 0.8rem;">
                    <i class="fas fa-sync-alt"></i> Live from database
                </small>
            </div>
            <div class="stat-card animate-on-scroll">
                <span class="stat-number" id="totalValue"><?php echo formatCurrency($stats['total_contract_value']); ?></span>
                <span class="stat-label">Total Contract Value</span>
                <small style="display: block; margin-top: 0.5rem; color: var(--text-secondary); font-size: 0.8rem;">
                    <i class="fas fa-chart-line"></i> Real-time calculation
                </small>
            </div>
            <div class="stat-card animate-on-scroll">
                <span class="stat-number" id="keyIndicators"><?php echo $stats['key_indicators']; ?></span>
                <span class="stat-label">Key Indicators</span>
                <small style="display: block; margin-top: 0.5rem; color: var(--text-secondary); font-size: 0.8rem;">
                    <i class="fas fa-ruler-combined"></i> Performance metrics
                </small>
            </div>
            <div class="stat-card animate-on-scroll">
                <span class="stat-number" id="totalOpportunities"><?php echo $stats['total_opportunities']; ?></span>
                <span class="stat-label">Business Opportunities</span>
                <small style="display: block; margin-top: 0.5rem; color: var(--text-secondary); font-size: 0.8rem;">
                    <i class="fas fa-briefcase"></i> Pipeline tracking
                </small>
            </div>
        </div>

        <!-- Search Box -->
        <div class="search-container">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
            <input type="text" id="searchBox" class="search-box" placeholder="Search features, modules, or capabilities...">
        </div>

        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
            <a href="#features" class="cta-button" style="font-size: 1.1rem;">
                <i class="fas fa-rocket"></i> Explore Features
            </a>
            <a href="#dashboard" class="cta-button" style="background: linear-gradient(135deg, var(--secondary-color), #00838f);">
                <i class="fas fa-tachometer-alt"></i> View Dashboard
            </a>
            <button class="cta-button" style="background: linear-gradient(135deg, var(--accent-color), #d81b60);" onclick="openModal('privacyModal')">
                <i class="fas fa-shield-alt"></i> Privacy Info
            </button>
        </div>

        <div style="margin-top: 3rem; padding: 1.5rem; background: var(--bg-secondary); border-radius: var(--border-radius); border: 1px solid var(--border-color); max-width: 800px; margin-left: auto; margin-right: auto;">
            <p style="color: var(--text-secondary); font-size: 0.9rem; text-align: center;">
                <i class="fas fa-lock"></i> <strong>SECURE ACCESS:</strong> This system contains confidential information. All activities are monitored and logged for security purposes.
                <a href="#" onclick="openModal('disclaimerModal'); return false;" style="color: var(--primary-color); text-decoration: underline;">View full disclaimer</a>
            </p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section">
        <div class="section-header">
            <h2 class="section-title">Powerful Features</h2>
            <p class="section-subtitle">Designed exclusively for internal organizational use. Comprehensive project monitoring, business development, and performance tracking.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card animate-on-scroll" data-search="project portfolio management lifecycle tracking">
                <div class="feature-icon">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h3 class="feature-title">Project Portfolio Management</h3>
                <p class="feature-description">
                    Complete lifecycle management from opportunity identification to project completion. Track timelines, budgets, deliverables, and team allocations in real-time with role-based access controls.
                </p>
                <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge">Timeline Tracking</span>
                    <span class="badge">Budget Management</span>
                    <span class="badge">Resource Allocation</span>
                </div>
            </div>

            <div class="feature-card animate-on-scroll" data-search="business development tracking opportunities pipeline">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="feature-title">Business Development Tracking</h3>
                <p class="feature-description">
                    Monitor opportunities pipeline, win rates, proposal development, and partner engagements. Make data-driven decisions for business growth with secure, confidential data handling.
                </p>
                <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge">Pipeline Analytics</span>
                    <span class="badge">Win Rate Analysis</span>
                    <span class="badge">Proposal Tracking</span>
                </div>
            </div>

            <div class="feature-card animate-on-scroll" data-search="financial performance monitoring budget profit">
                <div class="feature-icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <h3 class="feature-title">Financial Performance Monitoring</h3>
                <p class="feature-description">
                    Track budget utilization, profit margins, burn rates, and financial health across all projects with multi-currency support and secure financial reporting.
                </p>
                <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge">Budget Tracking</span>
                    <span class="badge">Profit Analysis</span>
                    <span class="badge">Multi-Currency</span>
                </div>
            </div>

            <div class="feature-card animate-on-scroll" data-search="partnership client management strategic relationships">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="feature-title">Partnership & Client Management</h3>
                <p class="feature-description">
                    Manage strategic partnerships, track MOUs, monitor engagement levels, and measure client satisfaction scores with secure relationship management tools.
                </p>
                <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge">MOU Tracking</span>
                    <span class="badge">Engagement Metrics</span>
                    <span class="badge">Client Satisfaction</span>
                </div>
            </div>

            <div class="feature-card animate-on-scroll" data-search="data collection analysis surveys research">
                <div class="feature-icon">
                    <i class="fas fa-database"></i>
                </div>
                <h3 class="feature-title">Data Collection & Analysis</h3>
                <p class="feature-description">
                    Comprehensive data collection tracking including household surveys, facility assessments, KIIs, FGDs, and respondent demographics with secure data storage.
                </p>
                <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge">Survey Management</span>
                    <span class="badge">Data Security</span>
                    <span class="badge">Analysis Tools</span>
                </div>
            </div>

            <div class="feature-card animate-on-scroll" data-search="real-time dashboard reporting analytics">
                <div class="feature-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3 class="feature-title">Real-time Dashboard & Reporting</h3>
                <p class="feature-description">
                    Interactive dashboards with key performance indicators, automated reports, and trend analysis for informed decision-making with role-based data visibility.
                </p>
                <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge">Interactive Dashboards</span>
                    <span class="badge">Automated Reports</span>
                    <span class="badge">Trend Analysis</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Preview Section -->
    <section id="dashboard" class="section" style="background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));">
        <div class="section-header">
            <h2 class="section-title">Live Dashboard Preview</h2>
            <p class="section-subtitle">Real-time insights from the MERQ M&E System (Sample data - actual system requires authentication)</p>
        </div>

        <div class="dashboard-metrics">
            <div class="metric-card animate-on-scroll">
                <div class="metric-value"><?php echo $stats['active_users']; ?>+</div>
                <div class="metric-label">Active Users</div>
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    <i class="fas fa-user-check"></i> System users
                </small>
            </div>

            <div class="metric-card animate-on-scroll">
                <div class="metric-value"><?php echo $stats['deliverables']; ?></div>
                <div class="metric-label">Project Deliverables</div>
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    <i class="fas fa-tasks"></i> Tracked items
                </small>
            </div>

            <div class="metric-card animate-on-scroll">
                <div class="metric-value"><?php echo $stats['active_partnerships']; ?>+</div>
                <div class="metric-label">Active Partnerships</div>
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    <i class="fas fa-handshake"></i> Strategic relationships
                </small>
            </div>

            <div class="metric-card animate-on-scroll">
                <div class="metric-value"><?php echo round($stats['total_contract_value'] / 1000000, 1); ?>M+</div>
                <div class="metric-label">Portfolio Value</div>
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    <i class="fas fa-chart-line"></i> Total contracts
                </small>
            </div>
        </div>

        <div class="features-grid" style="margin-top: 3rem;">
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon" style="background: linear-gradient(135deg, #4caf50, #2e7d32);">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <h3 class="feature-title">Performance Metrics</h3>
                <div style="margin-top: 1.5rem;">
                    <?php if (!empty($stats['performance_metrics'])): ?>
                        <?php foreach ($stats['performance_metrics'] as $metric): ?>
                            <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                                <span><?php echo htmlspecialchars($metric['metric_name']); ?></span>
                                <strong style="color: var(--success-color);"><?php echo formatPercentage($metric['ytd_value']); ?></strong>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                            <span>Project Win Rate</span>
                            <strong style="color: var(--success-color);">68.5%</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                            <span>On-time Delivery</span>
                            <strong style="color: var(--success-color);">92.3%</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                            <span>Client Satisfaction</span>
                            <strong style="color: var(--success-color);">94.7%</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0;">
                            <span>Budget Adherence</span>
                            <strong style="color: var(--success-color);">88.2%</strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="feature-card animate-on-scroll">
                <div class="feature-icon" style="background: linear-gradient(135deg, #2196f3, #0d47a1);">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h3 class="feature-title">Recent Projects</h3>
                <div style="margin-top: 1.5rem;">
                    <?php if (!empty($stats['recent_projects'])): ?>
                        <?php foreach ($stats['recent_projects'] as $project): ?>
                            <div style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                                <div style="display: flex; justify-content: space-between; align-items: start;">
                                    <strong><?php echo htmlspecialchars($project['project_name']); ?></strong>
                                    <span style="color: var(--primary-color); font-weight: 600;"><?php echo formatCurrency($project['total_value']); ?></span>
                                </div>
                                <small style="color: var(--text-secondary); display: block; margin-top: 0.25rem;">
                                    <i class="far fa-calendar"></i> Started: <?php echo date('M Y', strtotime($project['start_date'])); ?>
                                </small>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <strong>Health Systems Strengthening</strong>
                                <span style="color: var(--primary-color); font-weight: 600;">$2.4M</span>
                            </div>
                            <small style="color: var(--text-secondary); display: block; margin-top: 0.25rem;">
                                <i class="far fa-calendar"></i> Started: Jan 2024
                            </small>
                        </div>
                        <div style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <strong>Education Capacity Building</strong>
                                <span style="color: var(--primary-color); font-weight: 600;">$1.8M</span>
                            </div>
                            <small style="color: var(--text-secondary); display: block; margin-top: 0.25rem;">
                                <i class="far fa-calendar"></i> Started: Nov 2023
                            </small>
                        </div>
                        <div style="padding: 0.75rem 0;">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <strong>Agricultural Development</strong>
                                <span style="color: var(--primary-color); font-weight: 600;">$3.2M</span>
                            </div>
                            <small style="color: var(--text-secondary); display: block; margin-top: 0.25rem;">
                                <i class="far fa-calendar"></i> Started: Sep 2023
                            </small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="app/login.php" class="cta-button" style="padding: 1rem 2.5rem; font-size: 1.1rem;">
                <i class="fas fa-sign-in-alt"></i> Access Full Dashboard
            </a>
            <p style="margin-top: 1rem; color: var(--text-secondary); font-size: 0.9rem;">
                <i class="fas fa-lock"></i> Requires authentication and authorized access
            </p>
        </div>
    </section>

    <!-- Modules Section -->
    <section id="modules" class="section">
        <div class="section-header">
            <h2 class="section-title">Core System Modules</h2>
            <p class="section-subtitle">Integrated modules working together for comprehensive monitoring and evaluation (Internal use only)</p>
        </div>

        <div class="modules-container">
            <div class="module-card animate-on-scroll" data-search="projects module lifecycle tracking management">
                <div class="module-header">
                    <div class="module-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="module-title">Projects Module</h3>
                </div>
                <div class="module-content">
                    <ul class="module-features">
                        <li><i class="fas fa-check"></i> Complete project lifecycle tracking</li>
                        <li><i class="fas fa-check"></i> Timeline & milestone management</li>
                        <li><i class="fas fa-check"></i> Deliverable tracking with quality checks</li>
                        <li><i class="fas fa-check"></i> Team allocation & resource management</li>
                        <li><i class="fas fa-check"></i> Risk & issue tracking system</li>
                        <li><i class="fas fa-check"></i> Automated progress reporting</li>
                        <li><i class="fas fa-check"></i> Budget vs actual tracking</li>
                        <li><i class="fas fa-check"></i> Client communication logs</li>
                    </ul>
                </div>
            </div>

            <div class="module-card animate-on-scroll" data-search="opportunities module business development pipeline">
                <div class="module-header">
                    <div class="module-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="module-title">Opportunities Module</h3>
                </div>
                <div class="module-content">
                    <ul class="module-features">
                        <li><i class="fas fa-check"></i> Opportunity identification & tracking</li>
                        <li><i class="fas fa-check"></i> Go/No-Go decision tracking with analytics</li>
                        <li><i class="fas fa-check"></i> Proposal development workflow</li>
                        <li><i class="fas fa-check"></i> Submission & outcome tracking</li>
                        <li><i class="fas fa-check"></i> Win/loss analysis with insights</li>
                        <li><i class="fas fa-check"></i> Pipeline analytics & forecasting</li>
                        <li><i class="fas fa-check"></i> Partner collaboration tracking</li>
                        <li><i class="fas fa-check"></i> Market intelligence integration</li>
                    </ul>
                </div>
            </div>

            <div class="module-card animate-on-scroll" data-search="partnerships module relationship management mou">
                <div class="module-header">
                    <div class="module-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="module-title">Partnerships Module</h3>
                </div>
                <div class="module-content">
                    <ul class="module-features">
                        <li><i class="fas fa-check"></i> Partner identification & profiling</li>
                        <li><i class="fas fa-check"></i> MOU/agreement tracking with alerts</li>
                        <li><i class="fas fa-check"></i> Engagement level monitoring</li>
                        <li><i class="fas fa-check"></i> Joint opportunity tracking</li>
                        <li><i class="fas fa-check"></i> Partnership performance metrics</li>
                        <li><i class="fas fa-check"></i> Strategic relationship management</li>
                        <li><i class="fas fa-check"></i> Communication history tracking</li>
                        <li><i class="fas fa-check"></i> Capacity assessment tools</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="highlight-box animate-on-scroll">
            <h3 style="color: var(--primary-color); margin-bottom: 1.5rem;"><i class="fas fa-layer-group"></i> Additional Specialized Modules</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; justify-content: center;">
                <span class="badge" style="background: linear-gradient(135deg, #4caf50, #2e7d32);">Financial Tracking</span>
                <span class="badge" style="background: linear-gradient(135deg, #2196f3, #0d47a1);">Data Collection Management</span>
                <span class="badge" style="background: linear-gradient(135deg, #9c27b0, #6a1b9a);">Client Satisfaction</span>
                <span class="badge" style="background: linear-gradient(135deg, #ff9800, #ef6c00);">Risk Management</span>
                <span class="badge" style="background: linear-gradient(135deg, #00bcd4, #00838f);">Knowledge Output Tracking</span>
                <span class="badge" style="background: linear-gradient(135deg, #795548, #4e342e);">Performance Indicators</span>
                <span class="badge" style="background: linear-gradient(135deg, #607d8b, #37474f);">Audit & Compliance</span>
                <span class="badge" style="background: linear-gradient(135deg, #f44336, #c62828);">Reporting & Analytics</span>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section id="roles" class="section" style="background: var(--bg-secondary);">
        <div class="section-header">
            <h2 class="section-title">Role-Based Access Control</h2>
            <p class="section-subtitle">Secure, hierarchical access levels ensuring data confidentiality and appropriate system permissions</p>
        </div>

        <div class="features-grid">
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon" style="background: linear-gradient(135deg, #d32f2f, #b71c1c);">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3 class="feature-title">Administrator</h3>
                <p class="feature-description">
                    Full system access including user management, configuration, audit logs, and security settings. Can override all permissions and manage system-wide settings.
                </p>
                <div style="margin-top: 1.5rem;">
                    <div class="role-badge role-admin">
                        <i class="fas fa-user-cog"></i> Full System Control
                    </div>
                    <div class="role-badge role-admin">
                        <i class="fas fa-users-cog"></i> User Management
                    </div>
                    <div class="role-badge role-admin">
                        <i class="fas fa-clipboard-check"></i> Audit Access
                    </div>
                </div>
            </div>

            <div class="feature-card animate-on-scroll">
                <div class="feature-icon" style="background: linear-gradient(135deg, #1976d2, #0d47a1);">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="feature-title">Manager</h3>
                <p class="feature-description">
                    Project and team management access. Can view all project data, generate reports, manage team assignments, and approve workflows within their domain.
                </p>
                <div style="margin-top: 1.5rem;">
                    <div class="role-badge role-manager">
                        <i class="fas fa-project-diagram"></i> Project Management
                    </div>
                    <div class="role-badge role-manager">
                        <i class="fas fa-chart-bar"></i> Reporting Access
                    </div>
                    <div class="role-badge role-manager">
                        <i class="fas fa-user-check"></i> Team Supervision
                    </div>
                </div>
            </div>

            <div class="feature-card animate-on-scroll">
                <div class="feature-icon" style="background: linear-gradient(135deg, #388e3c, #1b5e20);">
                    <i class="fas fa-user"></i>
                </div>
                <h3 class="feature-title">Employee</h3>
                <p class="feature-description">
                    Task-specific access based on role. Can enter data, update assigned tasks, view relevant project information, and generate personal reports.
                </p>
                <div style="margin-top: 1.5rem;">
                    <div class="role-badge role-employee">
                        <i class="fas fa-tasks"></i> Task Management
                    </div>
                    <div class="role-badge role-employee">
                        <i class="fas fa-database"></i> Data Entry
                    </div>
                    <div class="role-badge role-employee">
                        <i class="fas fa-eye"></i> Limited View
                    </div>
                </div>
            </div>

            <div class="feature-card animate-on-scroll">
                <div class="feature-icon" style="background: linear-gradient(135deg, #f57c00, #e65100);">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3 class="feature-title">Consultant</h3>
                <p class="feature-description">
                    Project-specific access limited to assigned projects. Can view and contribute to specific project data but cannot access organizational-level information.
                </p>
                <div style="margin-top: 1.5rem;">
                    <div class="role-badge role-consultant">
                        <i class="fas fa-briefcase"></i> Project-Specific
                    </div>
                    <div class="role-badge role-consultant">
                        <i class="fas fa-pencil-alt"></i> Limited Contribution
                    </div>
                    <div class="role-badge role-consultant">
                        <i class="fas fa-clock"></i> Time-Bound Access
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial animate-on-scroll">
            <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-color);">
                "The role-based access in MERQ M&E System ensures that sensitive information is only accessible to authorized personnel.
                This layered security approach, combined with comprehensive audit trails, provides the confidentiality controls our organization requires
                while maintaining the collaborative functionality needed for effective monitoring and evaluation."
            </p>
            <div style="margin-top: 2rem; display: flex; align-items: center;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                    <i class="fas fa-user-shield" style="color: white; font-size: 1.5rem;"></i>
                </div>
                <div>
                    <h4 style="margin: 0; color: var(--text-color);">Staff Memeber</h4>
                    <p style="margin: 0; color: var(--text-secondary); font-size: 0.9rem;">MERQ Consultancy</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Stack -->
    <section id="technology" class="section">
        <div class="section-header">
            <h2 class="section-title">Technology Stack</h2>
            <p class="section-subtitle">Built on modern, scalable technologies for performance, reliability, and security</p>
        </div>

        <div class="tech-stack">
            <div class="tech-item animate-on-scroll">
                <div class="tech-icon">
                    <i class="fab fa-php"></i>
                </div>
                <div>
                    <h4>PHP Backend</h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Robust server-side processing with security layers</p>
                </div>
            </div>

            <div class="tech-item animate-on-scroll">
                <div class="tech-icon">
                    <i class="fas fa-database"></i>
                </div>
                <div>
                    <h4>MySQL Database</h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Relational data management with encryption</p>
                </div>
            </div>

            <div class="tech-item animate-on-scroll">
                <div class="tech-icon">
                    <i class="fab fa-js"></i>
                </div>
                <div>
                    <h4>JavaScript ES6+</h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Interactive frontend with modern features</p>
                </div>
            </div>

            <div class="tech-item animate-on-scroll">
                <div class="tech-icon">
                    <i class="fab fa-html5"></i>
                </div>
                <div>
                    <h4>HTML5 & CSS3</h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Modern responsive UI with accessibility</p>
                </div>
            </div>

            <div class="tech-item animate-on-scroll">
                <div class="tech-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div>
                    <h4>Metabase Integration</h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Advanced analytics and visualization</p>
                </div>
            </div>

            <div class="tech-item animate-on-scroll">
                <div class="tech-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h4>Security Suite</h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Encryption, audit trails, access controls</p>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 4rem;">
            <div class="feature-card animate-on-scroll">
                <h3 class="feature-title"><i class="fas fa-server"></i> Infrastructure</h3>
                <ul style="list-style: none; margin-top: 1rem;">
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 0.75rem;"></i>
                        Secure cloud hosting with 99.9% uptime
                    </li>
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 0.75rem;"></i>
                        Automated daily backups with 30-day retention
                    </li>
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 0.75rem;"></i>
                        DDoS protection and web application firewall
                    </li>
                    <li style="padding: 0.75rem 0;">
                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 0.75rem;"></i>
                        SSL/TLS encryption for all data transmission
                    </li>
                </ul>
            </div>

            <div class="feature-card animate-on-scroll">
                <h3 class="feature-title"><i class="fas fa-shield-alt"></i> Security Features</h3>
                <ul style="list-style: none; margin-top: 1rem;">
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 0.75rem;"></i>
                        Role-based access control (RBAC)
                    </li>
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 0.75rem;"></i>
                        Comprehensive audit logging
                    </li>
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 0.75rem;"></i>
                        Two-factor authentication support
                    </li>
                    <li style="padding: 0.75rem 0;">
                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 0.75rem;"></i>
                        IP whitelisting and geolocation controls
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section" style="background: var(--bg-secondary);">
        <div class="section-header">
            <h2 class="section-title">About MERQ M&E System</h2>
            <p class="section-subtitle">A comprehensive, secure solution for organizations committed to excellence in monitoring and evaluation</p>
        </div>

        <div style="max-width: 900px; margin: 0 auto;">
            <div class="highlight-box animate-on-scroll">
                <h3 style="color: var(--primary-color); margin-bottom: 1.5rem;"><i class="fas fa-bullseye"></i> Our Mission</h3>
                <p style="color: var(--text-color); line-height: 1.8; font-size: 1.1rem;">
                    To provide organizations with a powerful, integrated, and secure platform that simplifies complex monitoring and evaluation tasks,
                    transforms raw data into actionable insights, and enables evidence-based decision making for improved program outcomes and organizational excellence,
                    while maintaining the highest standards of data security and confidentiality.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </div>
                    <h3 class="feature-title">Scalable Architecture</h3>
                    <p class="feature-description">
                        Designed to grow with your organization, handling increasing data volumes and user demands without compromising performance or security.
                        Supports multi-organization deployments with data isolation.
                    </p>
                </div>

                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon" style="background: linear-gradient(135deg, var(--secondary-color), #00838f);">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3 class="feature-title">User-Centric Design</h3>
                    <p class="feature-description">
                        Intuitive interface designed for users at all technical levels, with comprehensive training materials,
                        contextual help, and responsive support. Accessibility compliant and mobile optimized.
                    </p>
                </div>
            </div>

            <div class="testimonial animate-on-scroll" style="margin-top: 3rem;">
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-color);">
                    "As an internal system, MERQ M&E has transformed our organizational efficiency. The comprehensive security features give us confidence in handling sensitive data,
                    while the powerful analytics capabilities provide insights that drive strategic decision-making. This isn't just software—it's an integral part of our operational excellence framework."
                </p>
                <div style="margin-top: 2rem; display: flex; align-items: center;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #9c27b0, #6a1b9a); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                        <i class="fas fa-user-tie" style="color: white; font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0; color: var(--text-color);">Staff Member</h4>
                        <p style="margin: 0; color: var(--text-secondary); font-size: 0.9rem;">MERQ Consultancy</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div>
                <h3>MERQ M&E System</h3>
                <div class="footer-info">
                    <strong>Internal Use Only</strong><br>
                    A comprehensive monitoring and evaluation platform for authorized organizational use. Not for public distribution or sale.
                </div>
                <div class="social-links">
                    <a href="#" class="social-link" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-link" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" title="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="mailto:support@merqconsultancy.org" class="social-link" title="Support">
                        <i class="fas fa-life-ring"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#home"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="#features"><i class="fas fa-chevron-right"></i> Features</a></li>
                    <li><a href="#modules"><i class="fas fa-chevron-right"></i> Modules</a></li>
                    <li><a href="#dashboard"><i class="fas fa-chevron-right"></i> Dashboard</a></li>
                    <li><a href="#technology"><i class="fas fa-chevron-right"></i> Technology</a></li>
                </ul>
            </div>

            <div>
                <h3>System Modules</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-briefcase"></i> Projects Management</a></li>
                    <li><a href="#"><i class="fas fa-lightbulb"></i> Business Development</a></li>
                    <li><a href="#"><i class="fas fa-handshake"></i> Partnership Tracking</a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i> Financial Monitoring</a></li>
                    <li><a href="#"><i class="fas fa-database"></i> Data Collection</a></li>
                </ul>
            </div>

            <div>
                <h3>Contact & Support</h3>
                <ul class="footer-links">
                    <li><a href="mailto:support@merqconsultancy.org"><i class="fas fa-life-ring"></i> Technical Support</a></li>
                    <li><a href="mailto:security@merqconsultancy.org"><i class="fas fa-shield-alt"></i> Security Concerns</a></li>
                    <li><a href="mailto:privacy@merqconsultancy.org"><i class="fas fa-user-shield"></i> Privacy Officer</a></li>
                    <li><a href="tel:+251911234567"><i class="fas fa-phone"></i> +251 91 123 4567</a></li>
                    <li><a href="#" onclick="openModal('disclaimerModal'); return false;"><i class="fas fa-exclamation-circle"></i> System Disclaimer</a></li>
                </ul>
            </div>
        </div>

        <div class="developer-info">
            <h4><i class="fas fa-code"></i> Development Information</h4>
            <p style="color: #adb5bd; margin-top: 0.5rem;">
                Developed by <strong>ISDHU (Information Systems and Digital Health Unit)</strong><br>
                Under <strong>Monitoring and Evaluations Directorate</strong><br>
                Version 2.0.0 | Last Updated: <?php echo date('F j, Y'); ?>
            </p>
        </div>

        <div class="copyright">
            <p>&copy; <?php echo $current_year; ?> MERQ Monitoring & Evaluation System. All rights reserved. <strong>Internal Use Only</strong> - Not for Public Distribution</p>
            <p style="margin-top: 1rem; font-size: 0.8rem; color: #adb5bd;">
                <a href="#" onclick="openModal('privacyModal'); return false;" style="color: #adb5bd; text-decoration: underline;">Privacy Policy</a> |
                <a href="#" onclick="openModal('disclaimerModal'); return false;" style="color: #adb5bd; text-decoration: underline;">Disclaimer</a> |
                <a href="mailto:support@merqconsultancy.org" style="color: #adb5bd; text-decoration: underline;">Support</a>
            </p>
            <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #6c757d;">
                <i class="fas fa-lock"></i> All system access is logged and monitored for security purposes. Unauthorized access is prohibited.
            </p>
        </div>
    </footer>

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

        // Mobile Menu Functions
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenuClose = document.getElementById('mobileMenuClose');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

        function openMobileMenu() {
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        mobileMenuBtn.addEventListener('click', openMobileMenu);
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const mobileThemeToggle = document.getElementById('mobileThemeToggle');
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
            if (mobileThemeToggle) {
                mobileThemeToggle.innerHTML = `<i class="fas ${icon}"></i>`;
            }
        }

        themeToggle.addEventListener('click', toggleTheme);
        if (mobileThemeToggle) {
            mobileThemeToggle.addEventListener('click', function() {
                toggleTheme();
                closeMobileMenu();
            });
        }

        // Scroll Animation
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate-on-scroll');

            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementTop < windowHeight - 100) {
                    element.classList.add('visible');
                }
            });
        };

        // Initial check
        animateOnScroll();

        // Listen for scroll
        window.addEventListener('scroll', animateOnScroll);

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();

                    // Close mobile menu if open
                    if (mobileMenu.classList.contains('active')) {
                        closeMobileMenu();
                    }

                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    // Update active nav link
                    updateActiveNavLink(targetId);
                }
            });
        });

        // Update active nav link
        function updateActiveNavLink(targetId) {
            // Update desktop nav links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === targetId) {
                    link.classList.add('active');
                }
            });

            // Update mobile nav links
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === targetId) {
                    link.classList.add('active');
                }
            });
        }

        // Update active nav link on scroll
        const sections = document.querySelectorAll('section[id]');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= sectionTop - 150) {
                    current = section.getAttribute('id');
                }
            });

            if (current) {
                updateActiveNavLink('#' + current);
            }
        });

        // Search Functionality
        const searchBox = document.getElementById('searchBox');
        const searchableElements = document.querySelectorAll('[data-search]');

        searchBox.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase().trim();

            if (searchTerm.length < 2) {
                // Show all elements if search is cleared or too short
                searchableElements.forEach(element => {
                    element.style.display = 'block';
                });
                return;
            }

            searchableElements.forEach(element => {
                const searchText = element.getAttribute('data-search').toLowerCase();
                if (searchText.includes(searchTerm)) {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            });
        });

        // Clear search on escape
        searchBox.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                searchBox.value = '';
                searchableElements.forEach(element => {
                    element.style.display = 'block';
                });
            }
        });

        // Modal Functions
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Close modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay.active').forEach(modal => {
                    const modalId = modal.id;
                    closeModal(modalId);
                });
            }
        });

        // Close modal when clicking outside
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    const modalId = this.id;
                    closeModal(modalId);
                }
            });
        });

        // Terms Acceptance
        function acceptTerms() {
            // Set cookie for 30 days
            const date = new Date();
            date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
            document.cookie = `merq_terms_accepted=true; expires=${date.toUTCString()}; path=/; Secure; SameSite=Strict`;

            // Close modal
            closeModal('termsModal');

            // Show confirmation
            showNotification('Terms accepted. Welcome to MERQ M&E System!', 'success');
        }

        function declineTerms() {
            showNotification('Access requires acceptance of terms. Please refresh to try again.', 'warning');
            // Don't close modal on decline
        }

        // Notification System
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existing = document.querySelector('.notification');
            if (existing) existing.remove();

            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div style="position: fixed; top: 100px; right: 20px; background: ${type === 'success' ? 'var(--success-color)' : type === 'warning' ? 'var(--warning-color)' : 'var(--info-color)'}; 
                     color: white; padding: 1rem 1.5rem; border-radius: var(--border-radius); box-shadow: var(--shadow-lg); 
                     z-index: 10000; display: flex; align-items: center; gap: 0.75rem; max-width: 400px; animation: slideIn 0.3s ease;">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; margin-left: auto;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // Add CSS for notification animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            .notification { animation: slideIn 0.3s ease; }
            .notification.removing { animation: slideOut 0.3s ease; }
        `;
        document.head.appendChild(style);

        // Cookie Management
        function checkCookies() {
            if (!navigator.cookieEnabled) {
                showNotification('Cookies are disabled. Please enable cookies for full functionality.', 'warning');
            }
        }

        // Initialize cookie check
        checkCookies();

        // Stats Counter Animation
        function animateStats() {
            const statCards = document.querySelectorAll('.stat-card');

            statCards.forEach(card => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const numberElement = card.querySelector('.stat-number');
                            const originalText = numberElement.textContent;

                            // Check if it's a number with + sign
                            const match = originalText.match(/(\d+)\+/);
                            if (match) {
                                const number = parseInt(match[1]);
                                if (!isNaN(number)) {
                                    animateCounter(numberElement, number);
                                }
                            }

                            observer.unobserve(card);
                        }
                    });
                }, {
                    threshold: 0.5
                });

                observer.observe(card);
            });
        }

        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current) + '+';
            }, 30);
        }

        // Initialize stats animation
        setTimeout(animateStats, 1000);

        // Add hover effects to cards
        document.querySelectorAll('.feature-card, .module-card, .tech-item, .metric-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchBox.focus();
            }

            // T for theme toggle
            if (e.altKey && e.key === 't') {
                toggleTheme();
            }
        });

        // System status check
        function checkSystemStatus() {
            const statusElement = document.createElement('div');
            statusElement.id = 'systemStatus';
            statusElement.style.cssText = 'position: fixed; bottom: 20px; right: 20px; background: var(--success-color); color: white; padding: 0.5rem 1rem; border-radius: var(--border-radius); font-size: 0.8rem; z-index: 1000; box-shadow: var(--shadow-md); display: flex; align-items: center; gap: 0.5rem;';
            statusElement.innerHTML = '<i class="fas fa-circle" style="font-size: 0.6rem;"></i> System Online';

            document.body.appendChild(statusElement);

            // Remove after 5 seconds
            setTimeout(() => {
                statusElement.style.opacity = '0';
                statusElement.style.transition = 'opacity 0.5s';
                setTimeout(() => statusElement.remove(), 500);
            }, 5000);
        }

        // Check system status after page loads
        setTimeout(checkSystemStatus, 2000);
    </script>
</body>

</html>