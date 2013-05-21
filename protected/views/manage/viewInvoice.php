<?php
require_once(dirname(__FILE__).'/../../components/ScheduleHelper.php');
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/css/payslip.css');
?>
<?php
$current_date = new DateTime();
?>

<div id="page-wrap">
<div id="header">
    <h2>INVOICE</h2>
</div>	
    <div id="identity">
		
        <div id="employee">
            <ul>
                <li>
                   <span class="title1">Student name:</span><?php echo $student->name; ?> 
                </li>
                <li>
                    <span class="title1">Email:</span> <?php echo $student->email; ?>
                </li>
                <li>
                    <span class="title1">Phone number:</span><?php echo $student->contact; ?>
                </li>
                <li>
                    <span class="title1">Year of study:</span><?php echo $student->year; ?> 
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
                           <span class="title1">Invoice number:</span><?php echo $invoice->number; ?> 
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
		      <th>Subject</th>
		      <th>Total($)</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td></td>
		      <td></td>
                      <td></td>
		      <td><?php echo $invoice->total; ?> </td>
		  </tr>

		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Subtotal($)</td>
		      <td class="total-value"><div id="subtotal"><?php echo $invoice->total; ?></div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Total($)</td>
		      <td class="total-value"><div id="total"><?php echo $invoice->total; ?></div></td>
		  </tr>
		</table>
		
		<div id="terms">
		  <h5>TERM</h5>
		  <p>The invoice ........................................................</p>
		</div>
</div>
	
