<?php
// config.php - Configuration and API setup
error_reporting(E_ALL);
ini_set('display_errors', 1);

// API Configuration
define('BASE_URL', 'https://formapp.merqconsultancy.org/api/v1');
define('API_KEY', 'Q5vxZHNxaX1JLgtNBizHaHLXTTDFLxhgmopOsY4d');
define('FORM_ID', 13);

// Database configuration (if needed for additional data)
$host = "127.0.0.1";
$user = "merq_portal";
$pass = "merq_portal";
$dbname = "merq_portal";

// Weights for different perspectives
$weights = [
    'Self-evaluation' => 0.20,
    'Supervisor' => 0.45,
    'Subordinate' => 0.25,
    'Colleague' => 0.10,
    'Other' => 0.00 // Not weighted
];

// Judgment criteria
$judgmentCriteria = [
    ['min' => 0, 'max' => 30, 'label' => 'Needs Significant Improvement'],
    ['min' => 31, 'max' => 60, 'label' => 'Developing'],
    ['min' => 61, 'max' => 75, 'label' => 'Meets Expectations'],
    ['min' => 76, 'max' => 90, 'label' => 'Exceeds Expectations'],
    ['min' => 91, 'max' => 100, 'label' => 'Outstanding']
];

// Function to make API requests
function makeApiRequest($endpoint, $params = [])
{
    $url = BASE_URL . $endpoint;
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . API_KEY,
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        return json_decode($response, true);
    }

    return false;
}

// Fetch all submissions
function getSubmissions()
{
    $submissions = makeApiRequest('/forms/' . FORM_ID . '/submissions', [
        'expand' => 'files,comments'
    ]);

    return $submissions ?: [];
}

// Fetch specific submission
function getSubmission($submissionId)
{
    return makeApiRequest('/forms/' . FORM_ID . '/submissions/' . $submissionId);
}

// Get all matrix questions with their categories
function getMatrixQuestions()
{
    return [
        'matrix_1' => 'Job Knowledge and Technical Skills',
        'matrix_2' => 'Quality of Work',
        'matrix_3' => 'Productivity and Efficiency',
        'matrix_4' => 'Communication Skills',
        'matrix_5' => 'Teamwork and Collaboration',
        'matrix_6' => 'Problem-Solving and Initiative',
        'matrix_7' => 'Professionalism and Work Ethic',
        'matrix_8' => 'Adaptability and Continuous Improvement',
        'matrix_9' => 'Overall Performance Assessment'
    ];
}

// Calculate scores based on weights and perspectives
function calculateWeightedScores($submissions)
{
    global $weights;

    $employeeScores = [];
    $matrixQuestions = getMatrixQuestions();

    foreach ($submissions as $submission) {
        // Extract perspective
        $perspective = '';
        $employeeId = '';
        $evaluatorName = '';
        $evaluatorEmail = '';

        foreach ($submission['answers'] as $answer) {
            if ($answer['name'] === 'radio_1') {
                $perspective = $answer['answer'];
            }
            if ($answer['name'] === 'selectlist_1') {
                $employeeId = is_array($answer['answer']) ? $answer['answer'][0] : $answer['answer'];
            }
            if ($answer['name'] === 'text_2') {
                $evaluatorName = $answer['answer'];
            }
            if ($answer['name'] === 'email_1') {
                $evaluatorEmail = $answer['answer'];
            }
        }

        if (empty($perspective) || empty($employeeId)) {
            continue;
        }

        // Initialize employee entry if not exists
        if (!isset($employeeScores[$employeeId])) {
            $employeeScores[$employeeId] = [
                'details' => [],
                'perspectives' => [],
                'scores' => [],
                'evaluations' => []
            ];
        }

        // Extract scores from matrix questions
        $scores = [];
        $totalScore = 0;
        $questionCount = 0;

        foreach ($submission['answers'] as $answer) {
            if (strpos($answer['name'], 'matrix_') === 0 && is_numeric($answer['answer'])) {
                $questionKey = preg_replace('/_\d+$/', '', $answer['name']);
                $score = (int)$answer['answer'];

                if (!isset($scores[$questionKey])) {
                    $scores[$questionKey] = [
                        'total' => 0,
                        'count' => 0,
                        'category' => $matrixQuestions[$questionKey] ?? 'Unknown'
                    ];
                }

                $scores[$questionKey]['total'] += $score;
                $scores[$questionKey]['count']++;

                $totalScore += $score;
                $questionCount++;
            }
        }

        // Calculate average for each category
        $categoryAverages = [];
        foreach ($scores as $key => $data) {
            if ($data['count'] > 0) {
                $categoryAverages[$key] = [
                    'average' => $data['total'] / $data['count'],
                    'category' => $data['category']
                ];
            }
        }

        // Calculate overall average
        $overallAverage = $questionCount > 0 ? $totalScore / $questionCount : 0;

        // Store evaluation data
        $evaluationData = [
            'submission_id' => $submission['id'],
            'perspective' => $perspective,
            'evaluator_name' => $evaluatorName,
            'evaluator_email' => $evaluatorEmail,
            'date' => $submission['created_at'],
            'overall_score' => $overallAverage,
            'category_scores' => $categoryAverages,
            'answers' => $submission['answers']
        ];

        $employeeScores[$employeeId]['evaluations'][] = $evaluationData;

        // Add to perspectives count
        if (!isset($employeeScores[$employeeId]['perspectives'][$perspective])) {
            $employeeScores[$employeeId]['perspectives'][$perspective] = 0;
        }
        $employeeScores[$employeeId]['perspectives'][$perspective]++;

        // Initialize scores by perspective if not exists
        if (!isset($employeeScores[$employeeId]['scores'][$perspective])) {
            $employeeScores[$employeeId]['scores'][$perspective] = [
                'total' => 0,
                'count' => 0
            ];
        }

        // Add to perspective scores
        $employeeScores[$employeeId]['scores'][$perspective]['total'] += $overallAverage;
        $employeeScores[$employeeId]['scores'][$perspective]['count']++;
    }

    // Calculate weighted averages for each employee
    foreach ($employeeScores as $employeeId => &$data) {
        $weightedTotal = 0;
        $totalWeight = 0;

        foreach ($data['scores'] as $perspective => $scoreData) {
            if (isset($weights[$perspective]) && $scoreData['count'] > 0) {
                $average = $scoreData['total'] / $scoreData['count'];
                $weightedTotal += $average * $weights[$perspective];
                $totalWeight += $weights[$perspective];
            }
        }

        // Adjust for missing perspectives
        if ($totalWeight > 0) {
            $data['weighted_score'] = ($weightedTotal / $totalWeight) * 100;
        } else {
            $data['weighted_score'] = 0;
        }

        // Determine judgment
        $data['judgment'] = determineJudgment($data['weighted_score']);
    }

    return $employeeScores;
}

// Determine judgment based on score
function determineJudgment($score)
{
    global $judgmentCriteria;

    foreach ($judgmentCriteria as $criterion) {
        if ($score >= $criterion['min'] && $score <= $criterion['max']) {
            return $criterion['label'];
        }
    }

    return 'Not Rated';
}

// Export to Excel
function exportToExcel($data, $filename = 'performance_evaluation_report')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
    header('Cache-Control: max-age=0');

    echo '<table border="1">';
    echo '<tr><th>Employee ID</th><th>Weighted Score</th><th>Judgment</th><th>Perspectives</th></tr>';

    foreach ($data as $employeeId => $employeeData) {
        $perspectives = '';
        foreach ($employeeData['perspectives'] as $perspective => $count) {
            $perspectives .= $perspective . ': ' . $count . '; ';
        }

        echo '<tr>';
        echo '<td>' . htmlspecialchars($employeeId) . '</td>';
        echo '<td>' . round($employeeData['weighted_score'], 2) . '%</td>';
        echo '<td>' . htmlspecialchars($employeeData['judgment']) . '</td>';
        echo '<td>' . htmlspecialchars($perspectives) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    exit;
}

// Export to PDF
function exportToPDF($data, $filename = 'performance_evaluation_report')
{
    require_once('tcpdf/tcpdf.php');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator('MERQ Consultancy');
    $pdf->SetAuthor('MERQ Consultancy');
    $pdf->SetTitle('Performance Evaluation Report');
    $pdf->SetSubject('Performance Evaluation Report');

    $pdf->AddPage();

    $html = '<h1>Performance Evaluation Report</h1>';
    $html .= '<table border="1" cellpadding="5">';
    $html .= '<tr><th>Employee ID</th><th>Weighted Score</th><th>Judgment</th><th>Perspectives</th></tr>';

    foreach ($data as $employeeId => $employeeData) {
        $perspectives = '';
        foreach ($employeeData['perspectives'] as $perspective => $count) {
            $perspectives .= $perspective . ': ' . $count . '; ';
        }

        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($employeeId) . '</td>';
        $html .= '<td>' . round($employeeData['weighted_score'], 2) . '%</td>';
        $html .= '<td>' . htmlspecialchars($employeeData['judgment']) . '</td>';
        $html .= '<td>' . htmlspecialchars($perspectives) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output($filename . '.pdf', 'D');
    exit;
}
