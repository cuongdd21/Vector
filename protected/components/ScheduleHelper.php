<?php

/**
 * This file assist in displaying the schedule page.
 *  check staff attendance, student attendance, generating html codes.
 */

/**
 * check if the staff attend the session or not
 * @param session, staff
 * @return boolean
 */
function checkStaffAttendance($session, $staff)
{
    if ($session->attendance == '') {
        return true;
    } else {
        $attend = $session->attendance;
        if ($attend[0] == '1') {
            return true;
        } else {
            return false;
        }

    }

}


/**
 * check student attend the session or not
 * @param session, student
 * @return boolena
 */

function checkStudentAttendance($session, $student)
{
    if ($session->attendance == '') {
        return true;
    } else {
        $attend = $session->attendance;
        $a = explode(',', $session->students_id);
        $key = array_search((string )$student->id, $a);
        $key++;
        if ($attend[$key] == '1') {
            return true;
        } else {
            return false;
        }
    }

}

/**
 * get the number of days from start_term to now
 * @return number of days
 */
function getDaysToNow()
{

    $date1 = Term::model()->getLatest()->start_time;
    $date2 = 'NOW';

    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $seconds_diff = $ts2 - $ts1;

    $days = floor($seconds_diff / 3600 / 24);
    return $days;
}
/**
 * get the day from it to text
 * @param  index
 * @return day in text
 */
function getDayText($i)
{
    if ($i == 1)
        return 'Monday';
    if ($i == 2)
        return 'Tuesday';
    if ($i == 3)
        return 'Wednesday';
    if ($i == 4)
        return 'Thursday';
    if ($i == 5)
        return 'Friday';
    if ($i == 6)
        return 'Sartuday';
    if ($i == 7)
        return 'Sunday';
}

/**
 * get the display name of the staff in a particular session
 * @param session
 * @return staff text of that sesion
 */
function getSessionStaffDisplay($session)
{

    $staff = Staff::model()->findByPk($session->staff_id);
    return $staff->display_name;
}
function getSessionStudentsDisplay($session)
{
    $a = explode(',', $session->students_id);
    $html = '';
    for ($i = 0; $i < count($a); $i++) {
        $student = Student::model()->findByPk($a[$i]);
        if ($i < (count($a) - 1)) {
            $html = $html . $student->display_name . ',';
        } else {
            $html = $html . $student->display_name;
        }

    }
    return $html;
}


/**
 * check if the student has the id in a string of id or not.
 * @param student, string of students
 * @return student string
 */
function checkStudentInString($student, $string)
{
    $student = ',' . $student . ',';
    $string = ',' . $string . ',';

    return strpos($string, $student);
}

/**
 * check if the session slot available for a day or not
 * @param day slot
 * @return boolean
 */
function getSessionAvailable($day, $slot)
{
    $sessions = $day->sessions;

    for ($i = 0; $i < count($sessions); $i++) {
        if ($sessions[$i]->slot == $slot) {
            return $sessions[$i];
        }


    }
    return null;

}

/**
 * return the html code for the sessions for a particular weekday
 * @param arrays of sessions
 * @return html code
 */
function printSessionWeekday($sessions)
{
    $a = array(
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100);
    for ($i = 0; $i < count($sessions); $i++) {
        $a[$sessions[$i]->slot] = $i;
        // a tuong ung voi session tuong ung.
    }

    $html = "";
    for ($i = 1; $i <= 3; $i++) {
        if ($i == 3) {
            $html = $html . "<div class='session-last'>";
        } else {
            $html = $html . "<div class='session'>";
        }
        for ($j = 1; $j <= 5; $j++) {
            $t = ($i - 1) * 5 + $j;
            if ($a[$t] == 100) // neu nhu khong co gi
                {
                if ($j == 5) {
                    $html = $html . "<div class='session-slot-last'></div>";
                } else {
                    $html = $html . "<div class='session-slot'></div>";
                }
            } else // neu nhu co gi do
            {
                if ($j == 5) {
                    $html_plus = "<div class='session-slot-last'><div class='sesion-slot-detail'><div class='session-slot-detail-top'>" .
                        getSessionStaffDisplay($sessions[$a[$t]]) .
                        "</div><div class='session-slot-detail-bottom'>" . getSessionStudentsDisplay($sessions[$a[$t]]) .
                        "</div></div></div>";
                    $html = $html . CHtml::link($html_plus, array('session/update/' . $sessions[$a[$t]]->
                            id));
                } else {
                    $html_plus = "<div class='session-slot'><div class='sesion-slot-detail'><div class='session-slot-detail-top'>" .
                        getSessionStaffDisplay($sessions[$a[$t]]) .
                        "</div><div class='session-slot-detail-bottom'>" . getSessionStudentsDisplay($sessions[$a[$t]]) .
                        "</div></div></div>";
                    $html = $html . CHtml::link($html_plus, array('session/update/' . $sessions[$a[$t]]->
                            id));
                }
            }
        }

        $html = $html . "</div>";
    }
    return $html;


}
/**
 * return the html code for the sessions for a particular weekend
 * @param  array of sessiosn
 * @return html cede
 */
function printSessionWeekend($sessions)
{
    $a = array(
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100,
        100);
    for ($i = 0; $i < count($sessions); $i++) {
        $a[$sessions[$i]->slot] = $i;
        // a tuong ung voi session tuong ung.
    }

    $html = "";
    for ($i = 1; $i <= 8; $i++) {
        if ($i == 8) {
            $html = $html . "<div class='session-last'>";
        } else {
            $html = $html . "<div class='session'>";
        }
        for ($j = 1; $j <= 5; $j++) {
            $t = ($i - 1) * 5 + $j;

            if ($a[$t] == 100) // neu nhu khong co gi
                {
                if ($j == 5) {
                    $html = $html . "<div class='session-slot-last'></div>";
                } else {
                    $html = $html . "<div class='session-slot'></div>";
                }
            } else // neu nhu co gi do
            {
                if ($j == 5) {
                    $html_plus = "<div class='session-slot-last'><div class='sesion-slot-detail'><div class='session-slot-detail-top'>" .
                        getSessionStaffDisplay($sessions[$a[$t]]) .
                        "</div><div class='session-slot-detail-bottom'>" . getSessionStudentsDisplay($sessions[$a[$t]]) .
                        "</div></div></div>";
                    $html = $html . CHtml::link($html_plus, array('session/update/' . $sessions[$a[$t]]->
                            id));
                } else {
                    $html_plus = "<div class='session-slot'><div class='sesion-slot-detail'><div class='session-slot-detail-top'>" .
                        getSessionStaffDisplay($sessions[$a[$t]]) .
                        "</div><div class='session-slot-detail-bottom'>" . getSessionStudentsDisplay($sessions[$a[$t]]) .
                        "</div></div></div>";
                    $html = $html . CHtml::link($html_plus, array('session/update/' . $sessions[$a[$t]]->
                            id));
                }
            }


        }

        $html = $html . "</div>";


    }
    return $html;


}


?>