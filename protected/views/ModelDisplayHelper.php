<?php

function getDayText2($day)
{
            if($day==1) return 'Monday';
        if($day==2) return 'Tuesday';
        if($day==3) return 'Wednesday';
        if($day==4) return 'Thursday';
        if($day==5) return 'Friday';
        if($day==6) return 'Sartuday';
        if($day==7) return 'Sunday';
        return 'unknown';
}

function getStudentText($id)
{
    return Student::model()->findByPk($id)->name;
    
}
function getStaffText($id)
{
    return Staff::model()->findByPk($id)->name;
    
}
?>