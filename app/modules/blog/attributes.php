<?php $oPost = $params['post']; ?>
<div class="post-attributes">
	<div id="fb-root"></div>
	<ul class="unstyled">
		<li>
			<i class="icon-user"></i>
			<?php $author = Blog_Helper::getAuthor($oPost['ID']); ?>
			<a href="/blog/author/<?= urlencode(strtolower($author)) ?>"><?= $author ?></a>
		</li>
		<?php
		$categories = Blog_Helper::getCategories($oPost['ID']);
		if (!empty($categories)) {
			?>
			<li>
				<i class="icon-folder-close"></i> 
				<ul class="unstyled" style="display:inline">
					<?php foreach ($categories as $category) { ?>
						<li style="display:inline">
							<a href="/blog/category/<?= urlencode(strtolower($category['name'])) ?>">
								<?= $category['name'] ?>
							</a>
						</li>
					<?php } ?>
				</ul>
			</li>
		<?php } ?>
		<?php
		$tags = Blog_Helper::getTags($oPost['ID']);
		if (!empty($tags)) {
			?>
			<li>
				<i class="icon-tag"></i> 
				<ul class="unstyled" style="display:inline">
					<?php foreach ($tags as $tag) { ?>
						<li style="display:inline">
							<a href="/blog/tag/<?= urlencode(strtolower($tag['name'])) ?>"><?= $tag['name'] ?></a>
						</li>
					<?php } ?>
				</ul>
			</li>
		<?php } ?>
		<!--li>
			<i class="icon-comment"></i> 
			<a href="#"><?php //echo Blog_Helper::getNumComments($oPost['ID']) ?> Comment</a>
		</li-->
	</ul>
</div>