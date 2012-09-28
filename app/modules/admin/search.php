<div class="grid_2" id="top-search">	
	<form>
		<input type="text" placeholder="Search" class="top-search-inp" />			
		<input type="submit" value="Search" class="submit btn-form"/>
	</form>
	<span class="user" style="padding-left:20px;margin-right:10px;float:left"><?php echo Fw_Register::getRef('user')['username']?></span>	
	<a href="" title="refresh"><span class="refresh"/></a>
	<a href="#" title="CCC(minify CSS&JS)"><span class="ccc"/></a>
	<a href="#" title="dump database"><span class="dump_database"/></a>
	<a href="#" title="dump database schema"><span class="dump_schema"/></a>
	<a href="#" title="dump project"><span class="dump_project"/></a>	
	<a href="<?php echo BASE_URI ?>" title="go to web"><span class="gotoweb"/></a>		
	<a href="<?php echo Fw_Router::getUrl('auth','logout') ?>" title="logout"><span class="logout"/></a>
</div>