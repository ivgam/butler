<?php
$page = $params['page'];
$count = $params['count'];
$page_end = (int) ceil($count / ITEMS_PER_PAGE);
$page_ini = ($page_end < 7) ? 1 : max(array(1, $page - 2));
$page_ini = ($page_ini + 6 > $page_end) ? $page_end - 6 : $page_ini;
$page_ini = max(array(1, $page_ini));
$uri = '';
$suffix = '';
foreach ($params['params'] as $k => $v) {
	$suffix .= '&' . urlencode($k) . '=' . urlencode($v);
}
?>
<div class="row">
    <div class="pagination pagination-centered">
		<span>Showing <?= (ITEMS_PER_PAGE * max($page, 1)) - ITEMS_PER_PAGE + 1 ?> to <?= min((ITEMS_PER_PAGE * max($page, 1)), $count) ?> of <?= $count ?></span>
        <br/>
		<ul class="pagination">
            <li><a href="<?php echo $uri . '?p=1' . $suffix ?>">&laquo;</a></li>
			<?php for ($i = $page_ini; ($i <= $page_ini + 3 && $i <= $page_end) || ($i <= $page_end && ($page_end - $page_ini <= 6)); $i++) { ?>
				<li <?php if ($i == $page) { ?>class="active"<?php } ?>><a href="<?php echo $uri . '?p=' . $i . $suffix ?>"><?php echo $i ?></a></li>
			<?php } ?>
			<?php if ($i < $page_end) { ?>
				<li class="disabled"><a href="">&hellip;</a></li>
				<?php for ($i = $page_end - 1; $i <= $page_end; $i++) { ?>
					<li <?php if ($i == $page) { ?>class="active"<?php } ?>><a href="<?php echo $uri . '?p=' . $i . $suffix ?>"><?php echo $i ?></a></li>
				<?php } ?>
			<?php } ?>
            <li><a href="<?php echo $uri . '?p=' . $page_end . $suffix ?>">&raquo;</a></li>
        </ul>
    </div>
</div>