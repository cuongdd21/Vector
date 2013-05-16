<div class="post">
    	<div class="title">
		posted by <?php echo  $data->author; ?>
	</div>
	<div class="author">
            <p>Feedback number: <?php echo $data->id; ?> <?php echo' on ' . $data->date_create ?></p>
	</div>
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
			$this->endWidget();
		?>
	</div>
    	<div class="nav">
		<b></b>
	</div>
</div>