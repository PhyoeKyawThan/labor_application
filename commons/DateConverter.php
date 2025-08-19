<?php

/**
 * Converts a Gregorian date string into a formatted Myanmar date string.
 *
 * @param string $date_string The date string from the database (e.g., '2025-02-20 10:30:00').
 * @return string The formatted Myanmar date string.
 */
function formatMyanmarDate($date_string)
{
    if (empty($date_string)) {
        return '';
    }

    $date = new DateTime($date_string);

    // Myanmar numbers mapping
    $myanmar_numbers = ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'];
    $myanmar_months = [
        1 => 'ဇန်နဝါရီ',
        2 => 'ဖေဖော်ဝါရီ',
        3 => 'မတ်',
        4 => 'ဧပြီ',
        5 => 'မေ',
        6 => 'ဇွန်',
        7 => 'ဇူလိုင်',
        8 => 'ဩဂုတ်',
        9 => 'စက်တင်ဘာ',
        10 => 'အောက်တိုဘာ',
        11 => 'နိုဝင်ဘာ',
        12 => 'ဒီဇင်ဘာ'
    ];


    $year = $date->format('Y');
    $month = (int) $date->format('m');
    $day = $date->format('d');


    $myanmar_year = str_replace(range(0, 9), $myanmar_numbers, $year);
    $myanmar_day = str_replace(range(0, 9), $myanmar_numbers, $day);


    $myanmar_month_name = $myanmar_months[$month];


    return $myanmar_year . ' ခုနှစ်၊ ' . $myanmar_month_name . ' လ၊ ' . $myanmar_day . ' ရက်';
}

function getMyanmarDateComponents($date_string)
{
    if (empty($date_string)) {
        return [];
    }

    try {
        $date = new DateTime($date_string);
    } catch (Exception $e) {
        return []; // Return an empty array on invalid date
    }

    $myanmar_numbers = ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'];
    $myanmar_months = [
        1 => '၀၁',
        2 => '၀၂',
        3 => '၀၃',
        4 => '၀၄',
        5 => '၀၅',
        6 => '၀၆',
        7 => '၀၇',
        8 => '၀၈',
        9 => '၀၉',
        10 => '၁၀',
        11 => '၁၁',
        12 => '၁၂'
    ];

    $year = $date->format('Y');
    $month = (int) $date->format('m');
    $day = $date->format('d');

    $myanmar_year = str_replace(range(0, 9), $myanmar_numbers, $year);
    $myanmar_day = str_replace(range(0, 9), $myanmar_numbers, $day);
    $myanmar_month_name = $myanmar_months[$month];

    return [
        'year' => $myanmar_year,
        'month' => $myanmar_month_name,
        'day' => $myanmar_day,
    ];
}

function engToBurmeseNumber($number) {
    $eng = ['0','1','2','3','4','5','6','7','8','9'];
    $mm  = ['၀','၁','၂','၃','၄','၅','၆','၇','၈','၉'];
    
    return str_replace($eng, $mm, $number);
}

?>