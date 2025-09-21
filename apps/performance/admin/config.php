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
    'Outstanding' => [90, 120],
    'Not Rated' => [0, 0] 
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

// Calculate weighted scores based on perspective
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

    // Calculate weighted scores for each employee
    foreach ($employeeEvaluations as $employeeId => &$data) {
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

        $data['weighted_score'] = $weightedSum;

        // Determine performance category
        $data['performance_category'] = getPerformanceCategory($weightedSum);

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
