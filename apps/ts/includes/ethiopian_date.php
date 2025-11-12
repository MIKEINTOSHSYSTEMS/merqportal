<?php
require_once __DIR__ . '/../config/constants.php';

class EthiopianDateConverter {


    public static function gregorianToEthiopian($gregDate) {
        $gregYear = date('Y', strtotime($gregDate));
        $gregMonth = date('n', strtotime($gregDate));
        $gregDay = date('j', strtotime($gregDate));

        // Ethiopian New Year in Gregorian calendar is September 11 or 12
        $ethYear = $gregYear;

        // Calculate days from Ethiopian New Year (Meskerem 1)
        $newYearDay = 12;
        
        $newYear = strtotime("$gregYear-09-$newYearDay");
        $currentDate = strtotime($gregDate);
        
        if ($currentDate >= $newYear) {
            $daysDiff = floor(($currentDate - $newYear) / (60 * 60 * 24));
        } else {
            $prevEthYear = $ethYear - 1;
            $prevNewYearDay = 12;
            $prevNewYear = strtotime(($gregYear - 1) . "-09-$prevNewYearDay");
            $daysDiff = floor(($currentDate - $prevNewYear) / (60 * 60 * 24));
        }
        
        // Calculate Ethiopian month and day
        $ethMonth = floor($daysDiff / 30) + 1;
        $ethDay = ($daysDiff % 30) + 1;
        
        // Handle Pagume (13th month)
        if ($ethMonth == 13) {
            $pagumeDays = ($ethYear % 4 == 3) ? 6 : 5;
            
            if ($ethDay > $pagumeDays) {
                $ethYear += 1;
                $ethMonth = 1;
                $ethDay = $ethDay - $pagumeDays;
            }
        }
        
        return [
            'year' => $ethYear,
            'month' => $ethMonth,
            'day' => $ethDay
        ];
    }
    
    public static function getEthiopianMonthDays($year, $month) {
        if ($month == 13) {
            return ($year % 4 == 3) ? 6 : 5;
        }
        return 30;
    }
    
    public static function getEthiopianWeekday($year, $month, $day) {
        $gregDate = self::ethiopianToGregorian($year, $month, $day);
        // date('N') returns 1=Monday, 7=Sunday
        // We need 0=Monday, 6=Sunday for our array indexing
        $weekdayIndex = date('N', strtotime($gregDate)) - 1;

        // Debug logging
        error_log("Ethiopian date $year-$month-$day -> Gregorian $gregDate -> weekday index $weekdayIndex");

        return $weekdayIndex;
    }

    public static function formatEthiopianDate($day, $month, $year) {
        return sprintf("%d/%d/%d", $day, $month, $year);
    }
    
    public static function ethiopianToGregorian($ethYear, $ethMonth, $ethDay) {
        $gregYear = $ethYear;

        $daysFromNewYear = ($ethMonth - 1) * 30 + ($ethDay - 1);

        if ($ethMonth == 13) {
            if ($ethYear % 4 == 3) {
                $daysFromNewYear = 360 + ($ethDay - 1);
            } else {
                $daysFromNewYear = 359 + ($ethDay - 1);
            }
        }

        $newYearDay = 12;
        
        $newYear = "$gregYear-09-$newYearDay";
        $gregDate = date('Y-m-d', strtotime("$newYear +$daysFromNewYear days"));
        
        return $gregDate;
    }
    
    public static function getCurrentEthiopianDate() {
        try {
            // Try API first with proper timeout and error handling
            $context = stream_context_create([
                'http' => [
                    'timeout' => 10,
                    'method' => 'GET',
                    'header' => 'User-Agent: MERQ Timesheet/1.0'
                ]
            ]);
            $apiResponse = @file_get_contents("https://api.ethioall.com/date/api", false, $context);

            if ($apiResponse !== false) {
                $data = json_decode($apiResponse, true);
                if ($data && isset($data['year'])) {
                    // Log successful API call
                    error_log("Ethiopian API Success: " . json_encode($data));

                    return [
                        'year' => intval($data['year']),
                        'month' => intval($data['month_number']),
                        'day' => intval($data['date']),
                        'month_name' => $data['month_amharic'] ?? 'Unknown',
                        'weekday' => $data['day_amharic'] ?? 'Unknown',
                        'english_month' => $data['month_english'] ?? 'Unknown',
                        'english_weekday' => $data['day_english'] ?? 'Unknown',
                        'source' => 'api'
                    ];
                }
            }
        } catch (Exception $e) {
            error_log("Ethiopian date API failed: " . $e->getMessage());
        }

        // Fallback to local calculation
        error_log("Using fallback Ethiopian date calculation");
        $currentGreg = date('Y-m-d');
        error_log("Current Gregorian date: $currentGreg");
        $ethDate = self::gregorianToEthiopian($currentGreg);
        error_log("Calculated Ethiopian date: " . json_encode($ethDate));
        $weekdayIndex = self::getEthiopianWeekday($ethDate['year'], $ethDate['month'], $ethDate['day']);

        return [
            'year' => $ethDate['year'],
            'month' => $ethDate['month'],
            'day' => $ethDate['day'],
            'month_name' => ETHIOPIAN_MONTHS_AMHARIC[$ethDate['month'] - 1],
            'weekday' => ETHIOPIAN_WEEKDAYS_AMHARIC[$weekdayIndex],
            'english_month' => ETHIOPIAN_MONTHS_ENGLISH[$ethDate['month'] - 1],
            'english_weekday' => ETHIOPIAN_WEEKDAYS_ENGLISH[$weekdayIndex],
            'source' => 'fallback'
        ];
    }

    public static function getEthiopianDateForMonth($year, $month, $day) {
        // For historical dates, we need to calculate rather than use current API
        // The API only gives current date, so we use local calculation for specific dates
        $gregDate = self::ethiopianToGregorian($year, $month, $day);
        $weekdayIndex = self::getEthiopianWeekday($year, $month, $day);

        return [
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'month_name' => ETHIOPIAN_MONTHS_AMHARIC[$month - 1],
            'weekday' => ETHIOPIAN_WEEKDAYS_AMHARIC[$weekdayIndex],
            'english_month' => ETHIOPIAN_MONTHS_ENGLISH[$month - 1],
            'english_weekday' => ETHIOPIAN_WEEKDAYS_ENGLISH[$weekdayIndex],
            'gregorian_date' => $gregDate,
            'source' => 'calculated'
        ];
    }
}
?>