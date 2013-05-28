<?php

/**
 * This file to assist displaying the payment page
 * 
 */

/**
 * get theprice list
 * @return array of price
 */

function getPriceId($inputPrice)
{
    if ($inputPrice === "PIJ")
        return 3;
    if ($inputPrice === "PGJ")
        return 1;
    if ($inputPrice === "UGJ")
        return 2;
    if ($inputPrice === "UIJ")
        return 4;
    if ($inputPrice === "PGS")
        return 5;
    if ($inputPrice === "UGS")
        return 6;
    if ($inputPrice === "PIS")
        return 7;
    if ($inputPrice === "UIS")
        return 8;

}
/**
 * get the day betwwen 2 dates
 * @return number of days
 */
function getDayBetweenDate($date1, $date2)
{
    $interval = $date1->diff($date2);
    return $interval->format('%a') + 1; // number of days
}
/**
 * save the payment for the staff within date range
 * @param date start, date end, staff id
 * @return number of days
 */
function savePayment($date1, $date2, $staff_id)
{
    $totalday = 0;
    $day1 = 0;
    $day2 = 0;
    $staff = Staff::model()->findByPk($staff_id);
    $count = count($staff->lessons);
    for ($k = 0; $k < $count; $k++) {
        $lesson = Lesson::model()->findByPk($staff->lessons[$k]->id);
        for ($i = 0; $i < count($lesson->sessions); $i++) {
            $session = $lesson->sessions[$i];
            $session_date = new DateTime(Day::model()->findByPk($session->day_id)->date);
            if ($date1 <= $session_date)
                $day1++;
            if ($date2 >= $session_date)
                $day2++;
        }
    }
    $lastPayslip = Payslip::model()->findAll(array('order' => "id DESC", 'limit' =>
            1));
    if (!$lastPayslip)
        $latest_id = 0;
    else
        $latest_id = $lastPayslip[0]->id;
    $staff_id = $staff->id;
    $totalday = $day2;
    $payslip = new Payslip;
    $payslip->grade = Paygrade::model()->findByPK($staff->paygrade_id)->name;
    $payslip->number = 'T' . $staff_id . 'PS' . $latest_id;
    $payslip->status = 1;
    $payslip->total = $totalday * Paygrade::model()->findByPK($staff->paygrade_id)->
        session;
    $newDate = new DateTime();
    $payslip->date_create = date_format($newDate, 'Y-m-d');
    $payslip->date_start = date_format($date1, 'Y-m-d');
    $payslip->date_end = date_format($date2, 'Y-m-d');
    $payslip->staff_id = $staff_id;
    if (!$payslip->save())
        throw new CHttpException("Unable to save payslip");
    return $payslip;
}
?>
