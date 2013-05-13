
<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/css/schedule.css');
?>
<?php

/* @var $this ScheduleController */

$this->breadcrumbs = array('Schedule', );
?>
<p>
<?php
require_once( dirname(__FILE__) . '/../../components/ScheduleHelper.php');
if (isset($_GET['week']))
{
$current_week = $_GET['week']-1;
}
else
{
$date1 = $term->start_time;
$date2 = 'NOW';
$ts1 = strtotime($date1);
$ts2 = strtotime($date2);
$seconds_diff = $ts2 - $ts1;
$days=floor($seconds_diff/3600/24);
    $current_week=floor($days/7);

}
$week=$term->weeks[$current_week];


?>
<div style="text-align:center;">
Week:
	<?php if($current_week==0) {echo '<b>';} echo CHtml::link("1",array('schedule/display/week/1')); if($current_week==0) {echo '</b>';}?>
    <?php if($current_week==1) {echo '<b>';} echo CHtml::link("2",array('schedule/display/week/2')); if($current_week==1) {echo '</b>';}?>
    <?php if($current_week==2) {echo '<b>';} echo CHtml::link("3",array('schedule/display/week/3')); if($current_week==2) {echo '</b>';}?>
    <?php if($current_week==3) {echo '<b>';} echo CHtml::link("4",array('schedule/display/week/4')); if($current_week==3) {echo '</b>';}?>
    <?php if($current_week==4) {echo '<b>';} echo CHtml::link("5",array('schedule/display/week/5')); if($current_week==4) {echo '</b>';}?>
    <?php if($current_week==5) {echo '<b>';} echo CHtml::link("6",array('schedule/display/week/6')); if($current_week==5) {echo '</b>';}?>
    <?php if($current_week==6) {echo '<b>';} echo CHtml::link("7",array('schedule/display/week/7')); if($current_week==6) {echo '</b>';}?>
    <?php if($current_week==7) {echo '<b>';} echo CHtml::link("8",array('schedule/display/week/8')); if($current_week==7) {echo '</b>';}?>
    <?php if($current_week==8) {echo '<b>';} echo CHtml::link("9",array('schedule/display/week/9')); if($current_week==8) {echo '</b>';}?>
    <?php if($current_week==9) {echo '<b>';} echo CHtml::link("10",array('schedule/display/week/10')); if($current_week==9) {echo '</b>';}?>
    
</div>
<p></p>


<div class='day'> <!-- Monday day 1 -->
            <div class='day-info'>
            <div class='day-info-date'>
           <?php
	       echo date_format(new DateTime($week->days[0]->date),"d/m");
            ?>
            </div>
            <div class='day-info-day'>
            MON
            </div>
            <div class='day-info-room'>
                <div class='day-info-room-space'>
                </div>
                <div class='day-info-room-r1'>
                R1
                </div>
                 <div class='day-info-room-r2'>
                 R2
                </div>
                <div class='day-info-room-r3'>
                R3
                </div>
            </div>
            </div>
            
            <div class='day-time'>
                <div class='time-slot'>0830
                </div>
                <div class='time-slot'>0900
                </div>
                <div class='time-slot'>0930
                </div>
                <div class='time-slot'>1000
                </div>
                <div class='time-slot'>1030
                </div>
                <div class='time-slot'>1100
                </div>
                <div class='time-slot'>1130
                </div>
                <div class='time-slot'>1200
                </div>
                <div class='time-slot'>1230
                </div>
                <div class='time-slot'>1300
                </div>
                <div class='time-slot'>1330
                </div>
                <div class='time-slot'>1400
                </div>
                <div class='time-slot'>1430
                </div>
                <div class='time-slot'>1500
                </div>
                <div class='time-slot'>1530
                </div>
                <div class='time-slot'>1600
                </div>
                <div class='time-slot'>1630
                </div>
                <div class='time-slot'>1700
                </div>
                <div class='time-slot'>1730
                </div>
                <div class='time-slot'>1800
                </div>
                <div class='time-slot'>1830
                </div>
                <div class='time-slot'>1900
                </div>
                <div class='time-slot'>1930
                </div>
                <div class='time-slot' style='border:none;'>2000
                </div>        
            </div>
            
            <div class='day-content'>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
<?php
    echo printSessionWeekday($term->weeks[$current_week]->days[0]->sessions);
?>
            </div>
        </div>
<!--DAY-->
       <div class='day'> <!-- Tuesday day 1 -->
            <div class='day-info'>
                        <div class='day-info-date'>
                                   <?php
	       echo date_format(new DateTime($week->days[1]->date),"d/m");
            ?>
            </div>
            <div class='day-info-day'>
            TUE
            </div>
            <div class='day-info-room'>
                <div class='day-info-room-space'>
                </div>
                <div class='day-info-room-r1'>
                R1
                </div>
                 <div class='day-info-room-r2'>
                 R2
                </div>
                <div class='day-info-room-r3'>
                R3
                </div>
            </div>

            </div>
            <div class='day-time'>
                <div class='time-slot'>0830
                </div>
                <div class='time-slot'>0900
                </div>
                <div class='time-slot'>0930
                </div>
                <div class='time-slot'>1000
                </div>
                <div class='time-slot'>1030
                </div>
                <div class='time-slot'>1100
                </div>
                <div class='time-slot'>1130
                </div>
                <div class='time-slot'>1200
                </div>
                <div class='time-slot'>1230
                </div>
                <div class='time-slot'>1300
                </div>
                <div class='time-slot'>1330
                </div>
                <div class='time-slot'>1400
                </div>
                <div class='time-slot'>1430
                </div>
                <div class='time-slot'>1500
                </div>
                <div class='time-slot'>1530
                </div>
                <div class='time-slot'>1600
                </div>
                <div class='time-slot'>1630
                </div>
                <div class='time-slot'>1700
                </div>
                <div class='time-slot'>1730
                </div>
                <div class='time-slot'>1800
                </div>
                <div class='time-slot'>1830
                </div>
                <div class='time-slot'>1900
                </div>
                <div class='time-slot'>1930
                </div>
                <div class='time-slot' style='border:none;'>2000
                </div>        
            </div>
            <div class='day-content'>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
<?php
    echo printSessionWeekday($term->weeks[$current_week]->days[1]->sessions);
?>
            </div>
        </div>
<!--DAY-->
       <div class='day'> <!-- Wednesday day 1 -->
            <div class='day-info'>
                        <div class='day-info-date'>
                                   <?php
	       echo date_format(new DateTime($week->days[2]->date),"d/m");
            ?>
            </div>
            <div class='day-info-day'>
            WED
            </div>
            <div class='day-info-room'>
                <div class='day-info-room-space'>
                </div>
                <div class='day-info-room-r1'>
                R1
                </div>
                 <div class='day-info-room-r2'>
                 R2
                </div>
                <div class='day-info-room-r3'>
                R3
                </div>
            </div>

            </div>
            <div class='day-time'>
                <div class='time-slot'>0830
                </div>
                <div class='time-slot'>0900
                </div>
                <div class='time-slot'>0930
                </div>
                <div class='time-slot'>1000
                </div>
                <div class='time-slot'>1030
                </div>
                <div class='time-slot'>1100
                </div>
                <div class='time-slot'>1130
                </div>
                <div class='time-slot'>1200
                </div>
                <div class='time-slot'>1230
                </div>
                <div class='time-slot'>1300
                </div>
                <div class='time-slot'>1330
                </div>
                <div class='time-slot'>1400
                </div>
                <div class='time-slot'>1430
                </div>
                <div class='time-slot'>1500
                </div>
                <div class='time-slot'>1530
                </div>
                <div class='time-slot'>1600
                </div>
                <div class='time-slot'>1630
                </div>
                <div class='time-slot'>1700
                </div>
                <div class='time-slot'>1730
                </div>
                <div class='time-slot'>1800
                </div>
                <div class='time-slot'>1830
                </div>
                <div class='time-slot'>1900
                </div>
                <div class='time-slot'>1930
                </div>
                <div class='time-slot' style='border:none;'>2000
                </div>        
            </div>
            <div class='day-content'>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
<?php
    echo printSessionWeekday($term->weeks[$current_week]->days[2]->sessions);
?>
            </div>
        </div>    
<!--DAY-->
       <div class='day'> <!-- Thursday day 1 -->
            <div class='day-info'>
                        <div class='day-info-date'>
                                   <?php
	       echo date_format(new DateTime($week->days[3]->date),"d/m");
            ?>
            </div>
            <div class='day-info-day'>
            THU
            </div>
            <div class='day-info-room'>
                <div class='day-info-room-space'>
                </div>
                <div class='day-info-room-r1'>
                R1
                </div>
                 <div class='day-info-room-r2'>
                 R2
                </div>
                <div class='day-info-room-r3'>
                R3
                </div>
            </div>

            </div>
            <div class='day-time'>
                <div class='time-slot'>0830
                </div>
                <div class='time-slot'>0900
                </div>
                <div class='time-slot'>0930
                </div>
                <div class='time-slot'>1000
                </div>
                <div class='time-slot'>1030
                </div>
                <div class='time-slot'>1100
                </div>
                <div class='time-slot'>1130
                </div>
                <div class='time-slot'>1200
                </div>
                <div class='time-slot'>1230
                </div>
                <div class='time-slot'>1300
                </div>
                <div class='time-slot'>1330
                </div>
                <div class='time-slot'>1400
                </div>
                <div class='time-slot'>1430
                </div>
                <div class='time-slot'>1500
                </div>
                <div class='time-slot'>1530
                </div>
                <div class='time-slot'>1600
                </div>
                <div class='time-slot'>1630
                </div>
                <div class='time-slot'>1700
                </div>
                <div class='time-slot'>1730
                </div>
                <div class='time-slot'>1800
                </div>
                <div class='time-slot'>1830
                </div>
                <div class='time-slot'>1900
                </div>
                <div class='time-slot'>1930
                </div>
                <div class='time-slot' style='border:none;'>2000
                </div>        
            </div>
            <div class='day-content'>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
<?php
    echo printSessionWeekday($term->weeks[$current_week]->days[3]->sessions);
?>
            </div>
        </div>    
<!--DAY-->
       <div class='day'> <!-- Friday day 1 -->
            <div class='day-info'>
                        <div class='day-info-date'>
                                   <?php
	       echo date_format(new DateTime($week->days[4]->date),"d/m");
            ?>
            </div>
            <div class='day-info-day'>
            FRI
            </div>
            <div class='day-info-room'>
                <div class='day-info-room-space'>
                </div>
                <div class='day-info-room-r1'>
                R1
                </div>
                 <div class='day-info-room-r2'>
                 R2
                </div>
                <div class='day-info-room-r3'>
                R3
                </div>
            </div>

            </div>
            <div class='day-time'>
                <div class='time-slot'>0830
                </div>
                <div class='time-slot'>0900
                </div>
                <div class='time-slot'>0930
                </div>
                <div class='time-slot'>1000
                </div>
                <div class='time-slot'>1030
                </div>
                <div class='time-slot'>1100
                </div>
                <div class='time-slot'>1130
                </div>
                <div class='time-slot'>1200
                </div>
                <div class='time-slot'>1230
                </div>
                <div class='time-slot'>1300
                </div>
                <div class='time-slot'>1330
                </div>
                <div class='time-slot'>1400
                </div>
                <div class='time-slot'>1430
                </div>
                <div class='time-slot'>1500
                </div>
                <div class='time-slot'>1530
                </div>
                <div class='time-slot'>1600
                </div>
                <div class='time-slot'>1630
                </div>
                <div class='time-slot'>1700
                </div>
                <div class='time-slot'>1730
                </div>
                <div class='time-slot'>1800
                </div>
                <div class='time-slot'>1830
                </div>
                <div class='time-slot'>1900
                </div>
                <div class='time-slot'>1930
                </div>
                <div class='time-slot' style='border:none;'>2000
                </div>        
            </div>
            <div class='day-content'>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
                <div class='session'>
                </div>
<?php
    echo printSessionWeekday($term->weeks[$current_week]->days[4]->sessions);
?>
            </div>
        </div>   
<!--DAY-->
       <div class='day'> <!-- Satruday day 1 -->
            <div class='day-info'>
                        <div class='day-info-date'>
                                   <?php
	       echo date_format(new DateTime($week->days[5]->date),"d/m");
            ?>
            </div>
            <div class='day-info-day'>
            SAR
            </div>
            <div class='day-info-room'>
                <div class='day-info-room-space'>
                </div>
                <div class='day-info-room-r1'>
                R1
                </div>
                 <div class='day-info-room-r2'>
                 R2
                </div>
                <div class='day-info-room-r3'>
                R3
                </div>
            </div>

            </div>
            <div class='day-time'>
                <div class='time-slot'>0830
                </div>
                <div class='time-slot'>0900
                </div>
                <div class='time-slot'>0930
                </div>
                <div class='time-slot'>1000
                </div>
                <div class='time-slot'>1030
                </div>
                <div class='time-slot'>1100
                </div>
                <div class='time-slot'>1130
                </div>
                <div class='time-slot'>1200
                </div>
                <div class='time-slot'>1230
                </div>
                <div class='time-slot'>1300
                </div>
                <div class='time-slot'>1330
                </div>
                <div class='time-slot'>1400
                </div>
                <div class='time-slot'>1430
                </div>
                <div class='time-slot'>1500
                </div>
                <div class='time-slot'>1530
                </div>
                <div class='time-slot'>1600
                </div>
                <div class='time-slot'>1630
                </div>
                <div class='time-slot'>1700
                </div>
                <div class='time-slot'>1730
                </div>
                <div class='time-slot'>1800
                </div>
                <div class='time-slot'>1830
                </div>
                <div class='time-slot'>1900
                </div>
                <div class='time-slot'>1930
                </div>
                <div class='time-slot' style='border:none;'>2000
                </div>        
            </div>
<?php
    echo printSessionWeekend($term->weeks[$current_week]->days[5]->sessions);
?>
        </div>   
 <!--DAY-->
       <div class='day-last'> <!-- Sunday day 1 -->
            <div class='day-info'>
                        <div class='day-info-date'>
                                   <?php
	       echo date_format(new DateTime($week->days[6]->date),"d/m");
            ?>
            </div>
            <div class='day-info-day'>
            SUN
            </div>
            <div class='day-info-room'>
                <div class='day-info-room-space'>
                </div>
                <div class='day-info-room-r1'>
                R1
                </div>
                 <div class='day-info-room-r2'>
                 R2
                </div>
                <div class='day-info-room-r3'>
                R3
                </div>
            </div>

            </div>
            <div class='day-time'>
                <div class='time-slot'>0830
                </div>
                <div class='time-slot'>0900
                </div>
                <div class='time-slot'>0930
                </div>
                <div class='time-slot'>1000
                </div>
                <div class='time-slot'>1030
                </div>
                <div class='time-slot'>1100
                </div>
                <div class='time-slot'>1130
                </div>
                <div class='time-slot'>1200
                </div>
                <div class='time-slot'>1230
                </div>
                <div class='time-slot'>1300
                </div>
                <div class='time-slot'>1330
                </div>
                <div class='time-slot'>1400
                </div>
                <div class='time-slot'>1430
                </div>
                <div class='time-slot'>1500
                </div>
                <div class='time-slot'>1530
                </div>
                <div class='time-slot'>1600
                </div>
                <div class='time-slot'>1630
                </div>
                <div class='time-slot'>1700
                </div>
                <div class='time-slot'>1730
                </div>
                <div class='time-slot'>1800
                </div>
                <div class='time-slot'>1830
                </div>
                <div class='time-slot'>1900
                </div>
                <div class='time-slot'>1930
                </div>
                <div class='time-slot' style='border:none;'>2000
                </div>        
            </div>
            <div class='day-content'>
                <?php
    echo printSessionWeekend($term->weeks[$current_week]->days[6]->sessions);
?>
            </div>
        </div>      
</p>

