<div id="recovery-modal" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Remember password</h3>
	</div>
	<div class="modal-body">
		<form id="recovery-form" class="form-horizontal" action="<?= BASE_URI ?>customer/recovery" method="POST">
			<div class="control-group">
				<label class="control-label" for="customer_email">Email:</label>
				<div class="controls">
					<input type="text" name="customer_email"/>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Close</a>
		<a href="#" id="recovery-send" class="btn btn-primary">Send</a>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#recovery-send').on('click',function(){
			$('#recovery-form').submit();
		});
	});
</script>