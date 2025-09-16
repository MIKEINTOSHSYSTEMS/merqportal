<?php
// functions.php - Additional helper functions
require_once 'config.php';

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

// Calculate scores by category for an employee
function calculateCategoryScores($evaluations)
{
    $categoryScores = [];

    foreach ($evaluations as $evaluation) {
        foreach ($evaluation['details']['answers'] as $answer) {
            if ($answer['type'] === 'matrix' && is_numeric($answer['answer'])) {
                $labelParts = explode(' > ', $answer['label']);
                if (count($labelParts) === 2) {
                    $category = $labelParts[0];
                    $score = (int)$answer['answer'];

                    if (!isset($categoryScores[$category])) {
                        $categoryScores[$category] = [
                            'scores' => [],
                            'count' => 0,
                            'total' => 0
                        ];
                    }

                    $categoryScores[$category]['scores'][] = $score;
                    $categoryScores[$category]['count']++;
                    $categoryScores[$category]['total'] += $score;
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

// Format data for Excel export
function formatForExcel($employeeEvaluations)
{
    $excelData = [];

    // Header row
    $excelData[] = [
        'Employee ID',
        'Employee Name',
        'Position',
        'Department',
        'Weighted Score',
        'Performance Category',
        'Self-evaluation Count',
        'Supervisor Count',
        'Subordinate Count',
        'Colleague Count',
        'Other Count',
        'Total Evaluations'
    ];

    // Data rows
    foreach ($employeeEvaluations as $employeeId => $data) {
        $employeeDetails = getEmployeeDetails($employeeId);

        $excelData[] = [
            $employeeId,
            $employeeDetails['name'],
            $employeeDetails['position'],
            $employeeDetails['department'],
            round($data['weighted_score'], 2) . '%',
            $data['performance_category'],
            $data['perspective_counts']['Self-evaluation'],
            $data['perspective_counts']['Supervisor'],
            $data['perspective_counts']['Subordinate'],
            $data['perspective_counts']['Colleague'],
            $data['perspective_counts']['Other'],
            array_sum($data['perspective_counts'])
        ];
    }

    return $excelData;
}

// Generate CSV file
function generateCSV($data, $filename)
{
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '.csv"');

    $output = fopen('php://output', 'w');
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM

    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
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
