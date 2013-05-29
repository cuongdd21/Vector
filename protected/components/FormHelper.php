<?php
/**
 * FormHelper assist the page to display in many forms
 * it returns the Room list, Slot list, Gender List, Staff list, Student list,
 * Weeklist, Daylist, Paygrade list, Subject list
 *  
 */

/**
 * from the session entity return the time coressponding to that session
 * @return String time
 */
function getRoomTime($session)
{

    $a = array();
    $day = Day::model()->findByPk($session->day_id);

    $slot = $session->slot;
    if ($day->day_no <= 5) {

        //weekday

        $slot2 = $slot - 1;
        $temp = floor($slot2 / 5);
        switch ($temp) {
            case 0:
                $a['time'] = 6;
                break;
            case 1:
                $a['time'] = 7;
                break;
            case 2:
                $a['time'] = 8;
                break;
        }

        $a['room'] = $slot2 - $temp * 5 + 1;
    } else {

        $slot2 = $slot - 1;
        $temp = floor($slot2 / 5);
        switch ($temp) {
            case 0:
                $a['time'] = 1;
                break;
            case 1:
                $a['time'] = 2;
                break;
            case 2:
                $a['time'] = 3;
                break;
            case 3:
                $a['time'] = 4;
                break;
            case 4:
                $a['time'] = 5;
                break;
            case 5:
                $a['time'] = 6;
                break;
            case 6:
                $a['time'] = 7;
                break;
            case 7:
                $a['time'] = 8;
                break;
        }
        $a['room'] = $slot2 - $temp * 5 + 1;
        // weekend
    }
    return $a;
}
/**
 * get the YesNo list
 * @return array of YesNo list
 */
function getYesNo()
{
    return array(0 => 'No', 1 => 'Yes');
}
/**
 * get the Slot list 
 * @return array of Slot list 1-24
 */
function getSlotListFull()
{
    return array(
        1 => "1",
        2 => "2",
        3 => "3",
        4 => "4",
        5 => "5",
        6 => "6",
        7 => "7",
        8 => "8",
        9 => "9",
        10 => "10",
        11 => "11",
        12 => "12",
        13 => "13",
        14 => "14",
        15 => "15",
        16 => "16",
        17 => "17",
        18 => "18",
        19 => "19",
        20 => "20",
        21 => "21",
        22 => "22",
        23 => "23",
        24 => "24");

}
/**
 * get the Slot list from session
 * @param session to get the slot from
 * @return array of Slot list 1-24
 */
function getSlotList($session)
{
    $day_no = $session->day->day_no;
    if ($day_no >= 6) {
        return array(
            1 => "1",
            2 => "2",
            3 => "3",
            4 => "4",
            5 => "5",
            6 => "6",
            7 => "7",
            8 => "8",
            9 => "9",
            10 => "10",
            11 => "11",
            12 => "12",
            13 => "13",
            14 => "14",
            15 => "15",
            16 => "16",
            17 => "17",
            18 => "18",
            19 => "19",
            20 => "20",
            21 => "21",
            22 => "22",
            23 => "23",
            24 => "24");
    } else {
        return array(
            1 => "1",
            2 => "2",
            3 => "3",
            4 => "4",
            5 => "5",
            6 => "6",
            7 => "7",
            8 => "8",
            9 => "9");

    }
    //<?php echo $form->dropDownList($model,'requester_id',$model->project->getUserOptions());
    //

}
/**
 * get the gender list
 * @return array of gender 
 */
function getGenderList()
{
    return array(0 => 'Male', 1 => 'Female');
}
/**
 * get the Term list from db
 * @return array of term list
 */
function getTermList()
{
    $terms = Term::model()->findAll();
    $list = CHtml::listData($terms, 'id', function ($terms)
    {
        $item = $terms->start_time; $string = explode(' ', $item); return CHtml::encode
            ($string[0]); }
    );
    return $list;
    //<?php echo $form->dropDownList($model,'requester_id',$model->project->getUserOptions());
    //
}

/**
 * get the Staff list from db
 * @return array of Staff
 */

function getStaffList()
{
    $criteria = new CDbCriteria();
    $criteria->compare('term_id', Term::model()->getLatest()->id);
    $staffs = Staff::model()->findAll($criteria);
    $list = CHtml::listData($staffs, 'id', function ($student)
    {
        return CHtml::encode($student->id . ' ' . $student->name); }
    );
    return $list;
    //<?php echo $form->dropDownList($model,'requester_id',$model->project->getUserOptions());
    //

}
/**
 * get the Student list from db
 * @return array of student list
 */
function getStudentList()
{

    $criteria = new CDbCriteria();
    $criteria->compare('term_id', Term::model()->getLatest()->id);
    $students = Student::model()->findAll($criteria);
    $list = CHtml::listData($students, 'id', function ($student)
    {
        return CHtml::encode($student->name); }
    );
    return $list;
    //<?php echo $form->dropDownList($model,'requester_id',$model->project->getUserOptions());
    //

}
/**
 * get the week list
 * @return array of weeklist 1-10
 */
function getWeekList()
{
    return array(
        1 => "Week 1",
        2 => "Week 2",
        3 => "Week 3",
        4 => "Week 4",
        5 => "Week 5",
        6 => "Week 6",
        7 => "Week 7",
        8 => "Week 8",
        9 => "Week 9",
        10 => "Week 10");
    //<?php echo $form->dropDownList($model,'requester_id',$model->project->getUserOptions());
    //

}
/**
 * get the Day list
 * @return array of Day list mon-sun
 */
function getDayList()
{
    return array(
        1 => "Monday",
        2 => "Tuesday",
        3 => "Wednesday",
        4 => "Thursday",
        5 => "Friday",
        6 => "Sartuday",
        7 => "Sunday");
    //<?php echo $form->dropDownList($model,'requester_id',$model->project->getUserOptions());
    //

}
/**
 * get the Roon list
 * @return array room 1-5
 */
function getRoomList()
{
    return array(
        1 => "Room 1",
        2 => "Room 2",
        3 => "Room 3",
        4 => "Room 4",
        5 => "Room 5",
        );
    //<?php echo $form->dropDownList($model,'requester_id',$model->project->getUserOptions());
    //

}
/**
 * get the Time list
 * @return array of time 
 */
function getTimeList()
{
    return array(
        1 => "08:30",
        2 => "10:00",
        3 => "11:30",
        4 => "13:00",
        5 => "14:30",
        6 => "16:00",
        7 => "17:30",
        8 => "19:00");
    //<?php echo $form->dropDownList($model,'requester_id',$model->project->getUserOptions());
    //

}
/**
 * get the paygrade list from db
 * @return array of paygrade list
 */
function getPayGradeList()
{
    $paygrade = Paygrade::model()->findAll();
    $list = CHtml::listData($paygrade, 'id', 'name');
    return $list;
}
/**
 * get the subject list
 * @return array of subject list
 */
function getSubjectList()
{
    return array(
        1 => "MATH",
        2 => "CHEMIST",
        3 => "PHYSIC",
        4 => "BIO",
        );
}

?>