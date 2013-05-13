<?php

class ScheduleController extends Controller
{
    	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations // we only allow deletion via POST request
		);
	}
	public function actionIndex()
	{
	   
  $slot1 = 5;
         $slot2=7;
         $a = array(0,0,0,0,0,0,0,0,0,0);
         $a[$slot1] =1;
         $a[$slot2] =1;
         /////CREATING HTML
         $html = "<table style='border:1px solid black'>";
         for ($i=1;$i<4;$i++)
         {
          $html=$html.'<tr>';
          for ($j=1;$j<4;$j++)
          {
              $number = ($i-1)*3+$j;
           $html = $html."<td style='border:1px solid black'>";
           if ($a[$number]!==0)
           {
           $html = $html.$a[$number];
           }
           else 
           {
              $html = $html.'0';
           }
           $html = $html.'</td>';   
          }
          $html=$html.'</tr>';
         }
         $html=$html.'</table>';
         ////END CREATING HTML
           
  		$this->render('index',array('slot1'=>$slot1,'slot2'=>$slot2,'a'=>$a,'html'=>$html));
 
	}
    public function actionDisplay()
    {      
       $term =Term::model()->getLatest();
    
        $weeks = $term->weeks;
        $display =1;
        
    
	$this->render('display',array('term'=>$term,'display'=>$display));

    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}