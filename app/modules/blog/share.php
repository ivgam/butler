<form class="form-horizontal" action="<?= BASE_URI ?>customer/subscribe" method="POST">
	<div style="margin-bottom:30px">
		<a href="#"
		   style="position: relative;bottom: 6px;margin-right: 10px;;"
		   onclick="
			   window.open(
			   'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
			   'facebook-share-dialog', 
			   'width=626,height=436'); 
			   return false;"
		   >Share on Facebook</a>
		<div class="fb-like" data-href="<?= BASE_URL . $_SERVER['REQUEST_URI'] ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
		<div class="g-plusone" data-size="medium"></div>
		<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<div class="control-group" style="display: inline-block;position:relative;bottom:6px">
			<div class="controls" style="margin:0; padding:0;display:inline-block">
				<input name="customer_email" placeholder="Receive our news via email" type="text"/>
				<input type="submit" class="btn btn-success btn-tiny" value="Subscribe"/>
			</div>
		</div>
	</div>
</form>