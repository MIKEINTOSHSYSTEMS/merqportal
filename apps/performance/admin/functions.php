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
