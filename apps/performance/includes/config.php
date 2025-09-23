<?php
// config.php - Configuration and API setup
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include session configuration but don't start session yet
require_once __DIR__ . '/../../../includes/ci-config.php';

// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../includes/session-config.php';
}

define('BASE_URL', 'https://formapp.merqconsultancy.org/api/v1');
define('API_KEY', 'Q5vxZHNxaX1JLgtNBizHaHLXTTDFLxhgmopOsY4d');
define('FORM_ID', 13);

// Database configuration
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'merq_portal');
define('DB_PASS', 'merq_portal');
define('DB_NAME', 'merq_portal');

// Performance evaluation weights
define('SELF_EVALUATION_WEIGHT', 0.20);
define('SUPERVISOR_WEIGHT', 0.45);
define('SUBORDINATE_WEIGHT', 0.25);
define('COLLEAGUE_WEIGHT', 0.10);

// Performance categories
$PERFORMANCE_CATEGORIES = [
    'Needs Significant Improvement' => [0, 30],
    'Developing' => [30, 60],
    'Meets Expectations' => [60, 75],
    'Exceeds Expectations' => [75, 90],
    'Outstanding' => [90, 100]
];

// Fetch data from API
function fetchFromAPI($endpoint, $params = [])
{
    $url = BASE_URL . $endpoint;
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-Api-Key: ' . API_KEY,
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        return json_decode($response, true);
    }

    error_log("API request failed: $url, HTTP Code: $httpCode");
    return false;
}

// Get all submissions
function getSubmissions()
{
    $submissions = fetchFromAPI('/forms/' . FORM_ID . '/submissions', [
        'expand' => 'files,comments'
    ]);

    return $submissions ?: [];
}

// Get employee details from database
function getEmployeesFromDatabase()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        error_log("DB Connection failed: " . $conn->connect_error);
        return [];
    }

    $sql = "SELECT 
                u.user_id, 
                u.employee_id,
                u.full_name,
                u.first_name,
                u.middle_name,
                u.last_name,
                u.email,    
                u.role,
                p.position_title, 
                d.department_name, 
                u.supervisor_id,
                s.full_name AS supervisor_name
            FROM users u
            LEFT JOIN positions p ON u.position_id = p.position_id
            LEFT JOIN departments d ON u.department_id = d.department_id
            LEFT JOIN users s ON u.supervisor_id = s.user_id
            WHERE u.user_id NOT IN (1, 2, 3)
            ORDER BY u.full_name ASC";

    $result = $conn->query($sql);
    $employees = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $employees[$row['user_id']] = $row;
        }
    }

    $conn->close();
    return $employees;
}

// Get employee details
function getEmployeeDetails($employeeId)
{
    $employees = getEmployeesFromDatabase();
    return isset($employees[$employeeId]) ? $employees[$employeeId] : [
        'full_name' => 'Unknown Employee',
        'position_title' => 'Unknown Position',
        'department_name' => 'Unknown Department',
        'email' => 'N/A'
    ];
}

// Calculate weighted scores based on perspective (FIXED VERSION)
function calculateWeightedScores($submissions)
{
    $weights = [
        'Self-evaluation' => SELF_EVALUATION_WEIGHT,
        'Supervisor' => SUPERVISOR_WEIGHT,
        'Subordinate' => SUBORDINATE_WEIGHT,
        'Colleague' => COLLEAGUE_WEIGHT,
        'Other' => 0.0 // Not included in weighted calculation
    ];

    $employeeEvaluations = [];

    foreach ($submissions as $submission) {
        $perspective = '';
        $employeeId = '';
        $scores = [];
        $evaluationDate = '';

        // Extract perspective, employee ID, and evaluation date
        foreach ($submission['answers'] as $answer) {
            if ($answer['name'] === 'radio_1') {
                $perspective = $answer['answer'];
            } elseif ($answer['name'] === 'selectlist_1') {
                $employeeId = is_array($answer['answer']) ? $answer['answer'][0] : $answer['answer'];
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

        if (empty($perspective) || empty($employeeId) || empty($scores)) {
            continue;
        }

        // Calculate average score for this evaluation
        $avgScore = array_sum($scores) / count($scores);
        $maxScore = 5; // Maximum score per question

        // Convert to percentage
        $scorePercent = ($avgScore / $maxScore) * 100;

        // Initialize employee record if not exists
        if (!isset($employeeEvaluations[$employeeId])) {
            $employeeEvaluations[$employeeId] = [
                'evaluations' => [],
                'weighted_score' => 0,
                'perspective_counts' => [
                    'Self-evaluation' => 0,
                    'Supervisor' => 0,
                    'Subordinate' => 0,
                    'Colleague' => 0,
                    'Other' => 0
                ],
                'category_scores' => [],
                'details' => getEmployeeDetails($employeeId)
            ];
        }

        // Store evaluation details
        $employeeEvaluations[$employeeId]['evaluations'][] = [
            'submission_id' => $submission['id'],
            'perspective' => $perspective,
            'score' => $scorePercent,
            'raw_score' => $avgScore,
            'submission_date' => !empty($evaluationDate) ? $evaluationDate : date('Y-m-d', $submission['created_at']),
            'details' => $submission
        ];

        // Update perspective count
        if (isset($employeeEvaluations[$employeeId]['perspective_counts'][$perspective])) {
            $employeeEvaluations[$employeeId]['perspective_counts'][$perspective]++;
        }
    }

    // Calculate weighted scores for each employee (FIXED LOGIC)
    foreach ($employeeEvaluations as $employeeId => &$data) {
        // Group evaluations by perspective and calculate average per perspective
        $perspectiveAverages = [];

        foreach ($data['evaluations'] as $evaluation) {
            $perspective = $evaluation['perspective'];
            if (!isset($perspectiveAverages[$perspective])) {
                $perspectiveAverages[$perspective] = [
                    'total' => 0,
                    'count' => 0
                ];
            }
            $perspectiveAverages[$perspective]['total'] += $evaluation['score'];
            $perspectiveAverages[$perspective]['count']++;
        }

        // Calculate average score for each perspective
        foreach ($perspectiveAverages as $perspective => $values) {
            $perspectiveAverages[$perspective] = $values['total'] / $values['count'];
        }

        // Calculate weighted score using perspective averages
        $weightedSum = 0;
        $appliedWeight = 0;

        foreach ($weights as $perspective => $weight) {
            if (isset($perspectiveAverages[$perspective]) && $weight > 0) {
                $weightedSum += $perspectiveAverages[$perspective] * $weight;
                $appliedWeight += $weight;
            }
        }

        // Normalize if not all weights were applied
        if ($appliedWeight > 0 && $appliedWeight < 1) {
            $weightedSum = $weightedSum / $appliedWeight;
        }

        // Ensure the score doesn't exceed 100%
        $data['weighted_score'] = min(100, $weightedSum);

        // Determine performance category
        $data['performance_category'] = getPerformanceCategory($data['weighted_score']);

        // Calculate category scores
        $data['category_scores'] = calculateCategoryScores($data['evaluations']);
    }

    return $employeeEvaluations;
}

// Calculate scores by category
function calculateCategoryScores($evaluations)
{
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

    $categoryScores = [];

    foreach ($categories as $category) {
        $categoryScores[$category] = [
            'scores' => [],
            'count' => 0,
            'total' => 0,
            'average' => 0,
            'percentage' => 0
        ];
    }

    foreach ($evaluations as $evaluation) {
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
    foreach ($categoryScores as $category => $data) {
        if ($data['count'] > 0) {
            $categoryScores[$category]['average'] = $data['total'] / $data['count'];
            $categoryScores[$category]['percentage'] = ($categoryScores[$category]['average'] / 5) * 100;
        }
    }

    return $categoryScores;
}

// Determine performance category based on score percentage
function getPerformanceCategory($score)
{
    global $PERFORMANCE_CATEGORIES;

    foreach ($PERFORMANCE_CATEGORIES as $category => $range) {
        if ($score >= $range[0] && $score <= $range[1]) {
            return $category;
        }
    }

    return 'Not Rated';
}

// Get strengths and areas of improvement for an employee
function getStrengthsAndImprovements($evaluations)
{
    $strengths = [];
    $improvements = [];

    foreach ($evaluations as $evaluation) {
        foreach ($evaluation['details']['answers'] as $answer) {
            if ($answer['type'] === 'textarea') {
                if (stripos($answer['label'], 'strength') !== false && !empty($answer['answer'])) {
                    $strengths[] = [
                        'text' => $answer['answer'],
                        'perspective' => $evaluation['perspective'],
                        'date' => $evaluation['submission_date']
                    ];
                } elseif ((stripos($answer['label'], 'improvement') !== false ||
                        stripos($answer['label'], 'area of') !== false) &&
                    !empty($answer['answer'])
                ) {
                    $improvements[] = [
                        'text' => $answer['answer'],
                        'perspective' => $evaluation['perspective'],
                        'date' => $evaluation['submission_date']
                    ];
                }
            }
        }
    }

    return ['strengths' => $strengths, 'improvements' => $improvements];
}

// Get all matrix questions from a submission
function getMatrixQuestions($submission)
{
    $matrixQuestions = [];

    foreach ($submission['answers'] as $answer) {
        if ($answer['type'] === 'matrix') {
            // Extract category and question from label
            $labelParts = explode(' > ', $answer['label']);
            if (count($labelParts) === 2) {
                $category = $labelParts[0];
                $question = $labelParts[1];

                if (!isset($matrixQuestions[$category])) {
                    $matrixQuestions[$category] = [];
                }

                if (!in_array($question, $matrixQuestions[$category])) {
                    $matrixQuestions[$category][] = $question;
                }
            }
        }
    }

    return $matrixQuestions;
}

// Check if user has access to employee data
function canAccessEmployeeData($requestedEmployeeId)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Admin can access all data
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
        return true;
    }

    // Users can only access their own data
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $requestedEmployeeId) {
        return true;
    }

    return false;
}

// Get CEO feedback for an employee (including drafts for CEO)
function getCEOFeedback($employeeId, $includeDrafts = false)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        error_log("DB Connection failed: " . $conn->connect_error);
        return [];
    }

    $sql = "SELECT 
                cf.*,
                cfc.category_name,
                cfc.category_description,
                u.full_name as ceo_name
            FROM ceo_feedback cf
            LEFT JOIN ceo_feedback_categories cfc ON cf.category_id = cfc.id
            LEFT JOIN users u ON cf.ceo_id = u.user_id
            WHERE cf.employee_id = ?";

    if (!$includeDrafts) {
        $sql .= " AND cf.status = 'published'";
    }

    $sql .= " ORDER BY 
                CASE cf.priority 
                    WHEN 'critical' THEN 1
                    WHEN 'high' THEN 2
                    WHEN 'medium' THEN 3
                    WHEN 'low' THEN 4
                    ELSE 5
                END,
                cf.created_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();

    $feedback = [];
    while ($row = $result->fetch_assoc()) {
        $feedback[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $feedback;
}

// Save CEO feedback
function saveCEOFeedback($employeeId, $ceoId, $feedbackData)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        return ['success' => false, 'message' => 'Database connection failed'];
    }

    $sql = "INSERT INTO ceo_feedback 
            (employee_id, ceo_id, category_id, feedback_text, priority, status, target_completion_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Handle empty target date
    $targetDate = (!empty($feedbackData['target_date']) && $feedbackData['target_date'] != '') ? $feedbackData['target_date'] : null;

    $stmt->bind_param(
        "iiissss",
        $employeeId,
        $ceoId,
        $feedbackData['category_id'],
        $feedbackData['text'],
        $feedbackData['priority'],
        $feedbackData['status'],
        $targetDate
    );

    if ($stmt->execute()) {
        $feedbackId = $conn->insert_id;
        $stmt->close();
        $conn->close();
        return ['success' => true, 'id' => $feedbackId];
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => $error];
    }
}

// Update CEO feedback
function updateCEOFeedback($feedbackId, $feedbackData)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        return ['success' => false, 'message' => 'Database connection failed'];
    }

    $sql = "UPDATE ceo_feedback 
            SET category_id = ?, feedback_text = ?, priority = ?, status = ?, 
                target_completion_date = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $targetDate = (!empty($feedbackData['target_date']) && $feedbackData['target_date'] != '') ? $feedbackData['target_date'] : null;

    $stmt->bind_param(
        "issssi",
        $feedbackData['category_id'],
        $feedbackData['text'],
        $feedbackData['priority'],
        $feedbackData['status'],
        $targetDate,
        $feedbackId
    );

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return ['success' => true];
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => $error];
    }
}

// Get single feedback item
function getCEOFeedbackItem($feedbackId)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        return null;
    }

    $sql = "SELECT 
                cf.*,
                cfc.category_name,
                cfc.category_description,
                u.full_name as ceo_name
            FROM ceo_feedback cf
            LEFT JOIN ceo_feedback_categories cfc ON cf.category_id = cfc.id
            LEFT JOIN users u ON cf.ceo_id = u.user_id
            WHERE cf.id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $feedbackId);
    $stmt->execute();
    $result = $stmt->get_result();

    $feedback = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $feedback;
}

// Get feedback responses
function getFeedbackResponses($feedbackId)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        return [];
    }

    $sql = "SELECT 
                cfr.*,
                u.full_name as employee_name
            FROM ceo_feedback_responses cfr
            LEFT JOIN users u ON cfr.employee_id = u.user_id
            WHERE cfr.feedback_id = ?
            ORDER BY cfr.submitted_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $feedbackId);
    $stmt->execute();
    $result = $stmt->get_result();

    $responses = [];
    while ($row = $result->fetch_assoc()) {
        $responses[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $responses;
}

// Save employee response
function saveFeedbackResponse($feedbackId, $employeeId, $responseText)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        return ['success' => false, 'message' => 'Database connection failed'];
    }

    $sql = "INSERT INTO ceo_feedback_responses 
            (feedback_id, employee_id, response_text) 
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "iis",
        $feedbackId,
        $employeeId,
        $responseText
    );

    if ($stmt->execute()) {
        $responseId = $conn->insert_id;
        $stmt->close();
        $conn->close();
        return ['success' => true, 'id' => $responseId];
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => $error];
    }
}

// Delete CEO feedback
function deleteCEOFeedback($feedbackId)
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        return ['success' => false, 'message' => 'Database connection failed'];
    }

    // First delete any responses
    $sql1 = "DELETE FROM ceo_feedback_responses WHERE feedback_id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $feedbackId);
    $stmt1->execute();
    $stmt1->close();

    // Then delete the feedback
    $sql2 = "DELETE FROM ceo_feedback WHERE id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $feedbackId);

    if ($stmt2->execute()) {
        $stmt2->close();
        $conn->close();
        return ['success' => true];
    } else {
        $error = $stmt2->error;
        $stmt2->close();
        $conn->close();
        return ['success' => false, 'message' => $error];
    }
}

// Get feedback categories
function getCEOFeedbackCategories()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        return [];
    }

    $sql = "SELECT * FROM ceo_feedback_categories WHERE is_active = TRUE ORDER BY display_order";
    $result = $conn->query($sql);

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    $conn->close();
    return $categories;
}

// Check if user is CEO
function isCEO($userId)
{
    return $userId == 35; // Your CEO user ID
}

// Function to set alert messages
function setAlert($message, $type = 'success')
{
    $_SESSION['alert_message'] = $message;
    $_SESSION['alert_type'] = $type;
}

// Function to display alerts
function displayAlerts()
{
    if (isset($_SESSION['alert_message'])) {
        $message = $_SESSION['alert_message'];
        $type = $_SESSION['alert_type'];

        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$type',
                title: '$message',
                confirmButtonColor: '#3085d6'
            });
        });
        </script>";

        // Clear the session variables
        unset($_SESSION['alert_message']);
        unset($_SESSION['alert_type']);
    }
}