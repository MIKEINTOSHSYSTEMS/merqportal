<?php
require_once 'config.php';

// Format datetime for display
function formatDateTime($dateString)
{
    if (empty($dateString)) {
        return '';
    }

    try {
        $date = new DateTime($dateString);
        $now = new DateTime();
        $diff = $now->diff($date);

        if ($diff->days === 0) {
            if ($diff->h === 0) {
                if ($diff->i < 1) {
                    return 'Just now';
                }
                return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
            }
            return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
        } elseif ($diff->days === 1) {
            return 'Yesterday at ' . $date->format('g:i A');
        } elseif ($diff->days < 7) {
            return $diff->days . ' day' . ($diff->days > 1 ? 's' : '') . ' ago';
        } else {
            return $date->format('M j, Y \a\t g:i A');
        }
    } catch (Exception $e) {
        error_log("Date formatting error: " . $e->getMessage());
        return '';
    }
}

function formatDate($dateString)
{
    if (empty($dateString)) {
        return '';
    }

    try {
        $date = new DateTime($dateString);
        return $date->format('F j, Y');
    } catch (Exception $e) {
        error_log("Date formatting error: " . $e->getMessage());
        return '';
    }
}

// Check if user is logged in
function isLoggedIn()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Redirect to login if not authenticated
function requireAuth()
{
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: /admin/login.php');
        exit;
    }
}

// Redirect to dashboard if already logged in
function redirectIfLoggedIn($returnUrl = null)
{
    if (isLoggedIn()) {
        $redirect = $returnUrl ?: getDefaultRedirectUrl();
        header('Location: ' . $redirect);
        exit;
    }
}

// Get appropriate redirect URL based on user role
function getDefaultRedirectUrl()
{
    if (isset($_SESSION['user_role'])) {
        switch ($_SESSION['user_role']) {
            case 'admin':
                return '/admin/dashboard.php';
            case 'manager':
            case 'supervisor':
                return '/manager/dashboard.php';
            default:
                return '/index.php';
        }
    }
    return '/index.php';
}

// Check if user is an admin
function isAdmin()
{
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

// Redirect to login if not admin
function requireAdmin()
{
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: /admin/login.php');
        exit;
    }

    if (!isAdmin()) {
        $_SESSION['error'] = 'Access denied. Administrator privileges required.';
        header('Location: /index.php');
        exit;
    }
}

// Generate password hash
function createPasswordHash($password)
{
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

// Verify password
function verifyPassword($password, $hash)
{
    return password_verify($password, $hash);
}

// Sanitize input
function sanitizeInput($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Validate email format
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Get user notifications
function getUserNotifications($userId = null)
{
    global $pdo;

    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return [];
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            $stmt = $pdo->prepare("
                SELECT n.*, 
                       CASE WHEN nr.notification_id IS NULL THEN 0 ELSE 1 END as is_read
                FROM notifications n
                LEFT JOIN notification_reads nr ON n.id = nr.notification_id AND nr.user_id = ?
                WHERE n.is_active = TRUE
                ORDER BY n.created_at DESC
                LIMIT 10
            ");
            $stmt->execute([$userId]);
        } else {
            // Fallback if notification_reads table doesn't exist yet
            $stmt = $pdo->prepare("
                SELECT n.*, 0 as is_read
                FROM notifications n
                WHERE n.is_active = TRUE
                ORDER BY n.created_at DESC
                LIMIT 10
            ");
            $stmt->execute();
        }

        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching notifications: " . $e->getMessage());
        return [];
    }
}


// Mark notification as unread
function markNotificationAsUnread($notificationId, $userId = null)
{
    global $pdo;

    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return false;
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            $stmt = $pdo->prepare("DELETE FROM notification_reads WHERE user_id = ? AND notification_id = ?");
            $stmt->execute([$userId, (int)$notificationId]);
            return $stmt->rowCount() > 0;
        }
    } catch (PDOException $e) {
        error_log("Error marking notification as unread: " . $e->getMessage());
    }

    return false;
}


// Mark all notifications as unread
function markAllNotificationsAsUnread($userId = null)
{
    global $pdo;

    // Use session user_id if $userId is not provided
    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return false;
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            // Delete all notifications for the user from the notification_reads table
            $stmt = $pdo->prepare("DELETE FROM notification_reads WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->rowCount() > 0;
        }
    } catch (PDOException $e) {
        error_log("Error marking all notifications as unread: " . $e->getMessage());
    }

    return false;
}



// Toggle notification read status
function toggleNotificationReadStatus($notificationId, $userId = null)
{
    global $pdo;

    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return false;
    }

    try {
        // Check if notification_reads table exists
        $tableExists = $pdo->query("SHOW TABLES LIKE 'notification_reads'")->fetch();

        if ($tableExists) {
            // Check current status
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM notification_reads WHERE user_id = ? AND notification_id = ?");
            $stmt->execute([$userId, (int)$notificationId]);
            $isRead = $stmt->fetchColumn() > 0;

            if ($isRead) {
                // Mark as unread
                $stmt = $pdo->prepare("DELETE FROM notification_reads WHERE user_id = ? AND notification_id = ?");
                $stmt->execute([$userId, (int)$notificationId]);
                return 'unread';
            } else {
                // Mark as read
                $stmt = $pdo->prepare("INSERT INTO notification_reads (user_id, notification_id) VALUES (?, ?) 
                                      ON DUPLICATE KEY UPDATE read_at = CURRENT_TIMESTAMP");
                $stmt->execute([$userId, (int)$notificationId]);
                return 'read';
            }
        }
    } catch (PDOException $e) {
        error_log("Error toggling notification status: " . $e->getMessage());
    }

    return false;
}


// Get user stats
function getUserStats($userId = null)
{
    global $pdo;

    if (!$userId && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if (!$userId) {
        return [];
    }

    $stats = [
        'pending_requests'   => 0,
        'approved_requests'  => 0,
        'rejected_requests'  => 0,
        'announcements'      => 0,
        'due_timesheets'     => 0,
        'leave_balance'      => 0   // <-- NEW
    ];

    try {
        // Get leave requests stats
        $stmt = $pdo->prepare("
            SELECT status, COUNT(*) as count 
            FROM leave_requests 
            WHERE user_id = ? 
            GROUP BY status
        ");
        $stmt->execute([$userId]);
        $leaveStats = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        $stats['pending_requests']  = $leaveStats['pending'] ?? 0;
        $stats['approved_requests'] = $leaveStats['approved'] ?? 0;
        $stats['rejected_requests'] = $leaveStats['rejected'] ?? 0;

        // Get active announcements count
        $stmt = $pdo->query("
            SELECT COUNT(*) as count 
            FROM announcements 
            WHERE is_active = TRUE 
            AND (end_date IS NULL OR end_date >= NOW())
        ");
        $stats['announcements'] = $stmt->fetchColumn();

        // Get due timesheets count (not submitted for current month)
        $currentMonth = date('n');
        $currentYear  = date('Y');

        $stmt = $pdo->prepare("
            SELECT COUNT(*) as count 
            FROM timesheets 
            WHERE user_id = ? 
            AND month = ? 
            AND year = ? 
            AND status != 'submitted'
        ");
        $stmt->execute([$userId, $currentMonth, $currentYear]);
        $stats['due_timesheets'] = $stmt->fetchColumn();

        // ✅ NEW: Get leave balance from users table
        $stmt = $pdo->prepare("SELECT leave_balance FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        $stats['leave_balance'] = (int)$stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("Error fetching user stats: " . $e->getMessage());
    }

    return $stats;
}


// Function to get performance stats using API calls
function getPerformanceStats($employeeId)
{
    // Initialize default stats
    $stats = [
        'weighted_score' => 0,
        'performance_category' => 'Not Evaluated',
        'total_evaluations' => 0,
        'perspective_counts' => [],
        'category_scores' => []
    ];

    try {
        // API configuration (same as in config.php)
        $baseUrl = 'https://formapp.merqconsultancy.org/api/v1';
        $apiKey = 'Q5vxZHNxaX1JLgtNBizHaHLXTTDFLxhgmopOsY4d';
        $formId = 13;

        // Fetch data from API
        $url = $baseUrl . '/forms/' . $formId . '/submissions?expand=files,comments';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Api-Key: ' . $apiKey,
            'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            $submissions = json_decode($response, true);

            // Calculate weighted scores (similar to calculateWeightedScores function)
            $weights = [
                'Self-evaluation' => 0.20,
                'Supervisor' => 0.45,
                'Subordinate' => 0.25,
                'Colleague' => 0.10,
                'Other' => 0.0
            ];

            $employeeEvaluations = [];

            foreach ($submissions as $submission) {
                $perspective = '';
                $submissionEmployeeId = '';
                $scores = [];
                $evaluationDate = '';

                // Extract perspective, employee ID, and evaluation date
                foreach ($submission['answers'] as $answer) {
                    if ($answer['name'] === 'radio_1') {
                        $perspective = $answer['answer'];
                    } elseif ($answer['name'] === 'selectlist_1') {
                        $submissionEmployeeId = is_array($answer['answer']) ? $answer['answer'][0] : $answer['answer'];
                    } elseif ($answer['name'] === 'date_1') {
                        $evaluationDate = $answer['answer'];
                    }

                    // Extract matrix scores (questions that are rated 1-5)
                    if ($answer['type'] === 'matrix' && is_numeric($answer['answer'])) {
                        $score = (int)$answer['answer'];
                        if ($score >= 1 && $score <= 5) {
                            $scores[] = $score;
                        }
                    }
                }

                if (empty($perspective) || empty($submissionEmployeeId) || empty($scores) || $submissionEmployeeId != $employeeId) {
                    continue;
                }

                // Calculate average score for this evaluation
                $avgScore = array_sum($scores) / count($scores);
                $maxScore = 5; // Maximum score per question

                // Convert to percentage
                $scorePercent = ($avgScore / $maxScore) * 100;

                // Initialize employee record if not exists
                if (!isset($employeeEvaluations[$submissionEmployeeId])) {
                    $employeeEvaluations[$submissionEmployeeId] = [
                        'evaluations' => [],
                        'weighted_score' => 0,
                        'perspective_counts' => [
                            'Self-evaluation' => 0,
                            'Supervisor' => 0,
                            'Subordinate' => 0,
                            'Colleague' => 0,
                            'Other' => 0
                        ],
                        'category_scores' => []
                    ];
                }

                // Store evaluation details
                $employeeEvaluations[$submissionEmployeeId]['evaluations'][] = [
                    'submission_id' => $submission['id'],
                    'perspective' => $perspective,
                    'score' => $scorePercent,
                    'raw_score' => $avgScore,
                    'submission_date' => !empty($evaluationDate) ? $evaluationDate : date('Y-m-d', $submission['created_at']),
                    'details' => $submission
                ];

                // Update perspective count
                if (isset($employeeEvaluations[$submissionEmployeeId]['perspective_counts'][$perspective])) {
                    $employeeEvaluations[$submissionEmployeeId]['perspective_counts'][$perspective]++;
                }
            }

            // Calculate weighted scores for the employee
            if (isset($employeeEvaluations[$employeeId])) {
                $data = $employeeEvaluations[$employeeId];
                $totalWeight = 0;
                $weightedSum = 0;

                foreach ($data['evaluations'] as $evaluation) {
                    $perspective = $evaluation['perspective'];

                    if (isset($weights[$perspective]) && $weights[$perspective] > 0) {
                        $weightedSum += $evaluation['score'] * $weights[$perspective];
                        $totalWeight += $weights[$perspective];
                    }
                }

                // If some perspectives are missing, adjust weights
                if ($totalWeight > 0 && $totalWeight < 1) {
                    $weightedSum = $weightedSum / $totalWeight;
                }

                // Determine performance category
                $performanceCategory = 'Not Rated';
                $PERFORMANCE_CATEGORIES = [
                    'Needs Significant Improvement' => [0, 30],
                    'Developing' => [30, 60],
                    'Meets Expectations' => [60, 75],
                    'Exceeds Expectations' => [76, 90],
                    'Outstanding' => [90, 100]
                ];

                foreach ($PERFORMANCE_CATEGORIES as $category => $range) {
                    if ($weightedSum >= $range[0] && $weightedSum <= $range[1]) {
                        $performanceCategory = $category;
                        break;
                    }
                }

                // Calculate category scores
                $categoryScores = [];
                $categories = [
                    'Job Knowledge and Technical Skills',
                    'Quality of Work',
                    'Productivity and Efficiency',
                    'Communication Skills',
                    'Teamwork and Collaboration',
                    'Problem-Solving and Initiative',
                    'Professionalism and Work Ethic',
                    'Adaptability and Continuous Improvement'
                ];

                foreach ($categories as $category) {
                    $categoryScores[$category] = [
                        'scores' => [],
                        'count' => 0,
                        'total' => 0,
                        'average' => 0,
                        'percentage' => 0
                    ];
                }

                foreach ($data['evaluations'] as $evaluation) {
                    foreach ($evaluation['details']['answers'] as $answer) {
                        if ($answer['type'] === 'matrix' && is_numeric($answer['answer'])) {
                            $labelParts = explode(' > ', $answer['label']);
                            if (count($labelParts) === 2) {
                                $category = $labelParts[0];
                                $score = (int)$answer['answer'];

                                if (isset($categoryScores[$category])) {
                                    $categoryScores[$category]['scores'][] = $score;
                                    $categoryScores[$category]['count']++;
                                    $categoryScores[$category]['total'] += $score;
                                }
                            }
                        }
                    }
                }

                // Calculate averages
                foreach ($categoryScores as $category => $scoreData) {
                    if ($scoreData['count'] > 0) {
                        $categoryScores[$category]['average'] = $scoreData['total'] / $scoreData['count'];
                        $categoryScores[$category]['percentage'] = ($categoryScores[$category]['average'] / 5) * 100;
                    }
                }

                // Prepare the final stats
                $stats = [
                    'weighted_score' => round($weightedSum, 1),
                    'performance_category' => $performanceCategory,
                    'total_evaluations' => array_sum($data['perspective_counts']),
                    'perspective_counts' => $data['perspective_counts'],
                    'category_scores' => $categoryScores
                ];
            }
        }
    } catch (Exception $e) {
        error_log("Performance stats API error: " . $e->getMessage());
    }

    return $stats;
}

?>