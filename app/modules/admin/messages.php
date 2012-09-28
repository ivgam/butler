<?php
$messages = Fw_Register::getMessages();
if (!empty($messages)) {
	foreach ($messages as $v) {
		?>
		<div id="message-<?php echo $v['color'] ?>" 
			 class="message <?php echo $v['color']?>">			
			<span><?php echo $v['text'] ?></span>			
		</div>
		<?php
	}
}
Fw_Register::clearMessages();
?>


