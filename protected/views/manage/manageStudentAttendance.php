<?php
require_once(dirname(__FILE__).'/../../components/ScheduleHelper.php');
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/css/attendance.css');


	$lesson = Lesson::model()->findByPk($student->lessons[0]->lesson_id);
    $student_id = $student->id;
    $days = getDaysToNow();
    // 0 = monday
    // 5 = sartuday
    // 6 = sunday
    $term = Term::model()->getLatest();
    
    $week = floor($days/7)+1;
    
    $day = $days % 7;
    
    $week_correct = $week-1;
    $day_correct = $day;
    //.....................
    
    $count = count($student->lessons);
    echo ' The Student has '.$count.' lesson(s) <br/>';
    for ($k=0;$k<$count;$k++)
    {
    //BEGIN FOR ONE LESSON
    	$lesson = Lesson::model()->findByPk($student->lessons[$k]->lesson_id);
        echo '<b>The Lesson '.($k+1).'</b>';
        echo '<div id="table">';
        echo '<table>';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Time</th>';
        echo '<th>Subject</th>';
        echo '<th>Tutor</th>';
        echo '<th>Attendance</th>';
        echo '</tr>';
        // echo content here
        for ($i=0;$i<count($lesson->sessions);$i++)
        {
            $session = $lesson->sessions[$i];
            if ((strtotime(date_format(new DateTime(Day::model()->findByPk($session->day_id)->date),"m/d/y"))<(strtotime("NOW"))+24*3600)&&(checkStudentAttendance($session,$student)))
            {
               echo '<tr>';
               echo '<td>'.(string)date_format(new DateTime(Day::model()->findByPk($session->day_id)->date),'m/d/y').'</td>';
               echo '<td>'.$session->getTime().'</td>';
               echo '<td>'.$session->getSubject().'</td>';
               echo '<td>'.$session->getStaffText().'</td>';
               echo '<td>1</td>';
               echo '</tr>';
               
               
              
                
            }
            else
            break;
        }
        
        // echo session content
       
        echo '</table>';
        echo '</div>';
        
    //END FOR ONE LESSON
    }
?>