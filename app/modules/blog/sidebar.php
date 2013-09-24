<h3>Pages</h3>
<ul class="unstyled" id="pages">
	<?php
	$aPages = Blog_Helper::getPages();
	foreach ($aPages as $oPage) {
		?>
		<li><a href="/blog/page/<?= $oPage['post_name'] ?>"><?= $oPage['post_title'] ?></a></li>
	<?php } ?>
</ul>
<h3>Blogroll</h3>
<ul class="unstyled" id="blogs">
	<?php
	$aBlogs = Blog_Helper::getBlogs();
	foreach ($aBlogs as $oBlog) {
		?>
		<li><a rel="dofollow" href="<?= $oBlog['link_url'] ?>"><?= $oBlog['link_name'] ?></a></li>
	<?php } ?>
</ul>
<form class="form-horizontal" action="<?= BASE_URI ?>customer/subscribe" method="POST" style="margin-top:30px">
	<div class="control-group" style="display: inline-block;position:relative;bottom:6px">
		<div class="controls" style="margin:0; padding:0;display:inline-block;">
			<input name="customer_email" placeholder="Receive our news via email" type="text" style="font-size: 10px; width:140px"/>
			<input type="submit" class="btn btn-success btn-tiny" value="Subscribe"/>
		</div>
	</div>
</form>