<?php
require_once(dirname(__FILE__).'/../../components/ScheduleHelper.php');
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/payslip.css');

?>
<?php
$current_date = new DateTime();
?>
<div id="page-wrap">
<div id="header">
    <h2>PAYSLIP</h2>
</div>	
    <div id="identity">
		
        <div id="employee">
            <ul>
                <li>
                   <span class="title1">Employee's Name:</span><?php echo $staff->name; ?> 
                </li>
                <li>
                    <span class="title1">Address:</span> <?php echo $staff->address; ?>
                </li>
                <li>
                    <span class="title1">Phone number:</span><?php echo $staff->contact; ?>
                </li>
                <li>
                    <span class="title1">TFN:</span><?php echo $staff->TFN; ?> 
                </li>
                <li>
                    <span class="title1">ABN:</span><?php echo $staff->AN; ?> 
                </li> 
                <li>
                    <span class="title1">BSB:</span><?php echo $staff->BSB; ?> 
                </li>                   
            </ul>
        </div>
            <div id="logo">
             <?php echo CHtml::image(Yii::app()->request->baseUrl."/images/logo.jpg","logo",array('id'=>'image'));
               ?> 
                <div id="employer">
                    <p>
                        Employer: Vector Tutoring
                    </p>
                </div>
            </div>

		
    </div>
		
		<div style="clear:both"></div>
		
		<div id="payment">
                    <ul id ='payslip-info'>
                        <li>
                           <span class="title1">Paygrade:</span><?php echo $payslip->grade; ?> 
                        </li>
                        <li>
                            <span class="title1">Pay period:</span><?php echo "From $payslip->date_start to $payslip->date_end"; ?> 
                        </li>
                        <li>
                            <span class="title1">Date of payment:</span><?php echo $current_date->format('d/m/Y'); ?>  
                        </li>
              
                    </ul>
		</div>		
		<table id="items">
		
		  <tr>
		      <th>Type</th>
		      <th>Description</th>
		      <th>Sessions</th>
		      <th>Total($)</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td>UnKnown</td>
		      <td>MTH</td>
                      <td><?php echo $sessions; ?> </td>
		      <td><?php echo $payslip->total; ?> </td>
		  </tr>

		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal"><?php echo $payslip->total; ?></div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Total</td>
		      <td class="total-value"><div id="total"><?php echo $payslip->total; ?></div></td>
		  </tr>
		</table>
		
		<div id="terms">
		  <h5>NOTE</h5>
		  <p>The payslip has already included the GPS, use it as bank cheque, good luck</p>
		</div>
</div>               
