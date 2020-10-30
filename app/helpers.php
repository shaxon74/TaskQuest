<?php

// 引数$date_typeから現在の日付/週末/月末の値を返す。
// $date_type = 1 :現在の日付
//              2 :週末(日曜日)
//              3 :月末
function limit_date(int $date_type) {
    $now = new DateTimeImmutable(); // 現在の日付
    switch ($date_type) {
        case 1: // 現在の日付
            return (string)$now->format('Y/m/d');
            break;
        case 2: // 週末(日曜日)
            return (string)next_weekend($now)->format('Y/m/d');
            break;
        case 3: // 月末
            return (string)$now->format('Y/m/t');
            break;
        default:
            return "ERROR_DATE_TYPE";
    }
}

// 日付から次の週末(日曜日)を返す関数
// 日付の曜日が日曜日の場合、現在の日付を返す。
function next_weekend(DateTimeImmutable $now) {
    $w = (int)$now->format('w');        // 日～土を0～6として返す。
    // 月～土の場合6～1に変換。
    if ( $w != 0 ) {
        $w = 7 - $w;
    }
    $weekend = $now->add(new DateInterval('P' . ($w)  . 'D'));
    return $weekend;
}
