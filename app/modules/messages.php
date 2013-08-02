<?php
$messages = Fw_Register::getMessages();
if (!empty($messages)) {
    foreach ($messages as $v) {
        ?>
        <div class="alert alert-<?php echo $v['type'] ?>">			
            <button type="button" class="close" data-dismiss="alert">×</button>
            <span><?php echo $v['text'] ?></span>
        </div>
        <?php
    }
}
Fw_Register::clearMessages();
?>


