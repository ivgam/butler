<script type="text/javascript">
	$(document).ready(function(){
		var breadcrumb = ['what-would-to-do'];
		var index = 0;
		function showLastTable(id){
			if(id.indexOf('table', 0) != -1){
				$('#relationships-form').css('display','block');
			} else {
				$('#relationships-form').css('display','none');
			}
		}
		$('a[class$=button]').click(function(){
			index++;
			$(this).parent().css('display','none');
			var tmp = $(this).attr('id').toString().replace('button','form');
			breadcrumb[index] = tmp;
			$('#'+tmp).css('display','block');
			showLastTable(tmp);
		});
		$('.prev').click(function(){
			$('#'+breadcrumb[index]).css('display','none');
			index--;
			$('#'+breadcrumb[index]).css('display','block');
			showLastTable(breadcrumb[index]);
		});
		$('.next').click(function(){
			$('#'+breadcrumb[index]).css('display','none');
			index++;
			$('#'+breadcrumb[index]).css('display','block');
		});
	});
</script>
<div id="configuration">
	<h4>
		CRUD
		<a href="#" class="prev">Prev</a>
		<a href="#" class="next">Next</a>
	</h4>		
	<div class="row" id="what-would-to-do">
		<h5>What do you would to do?</h5>
		<a href="#" class="medium button" id="new-controller-button">Create New Controller</a>
		<a href="#" class="medium button" id="already-controller-button">Modify Controller</a>
	</div>
	<div class="row" id="new-controller-form" style="display: none">
		<h5>Specify the controller link table</h5>
		<a href="#" class="medium button" id="new-table-button">Create New Table</a>
		<a href="#" class="medium button" id="already-table-button">Use an already created Table</a>
	</div>
	<div class="row" id="already-controller-form" style="display:none">
		Already controller
	</div>
	<div class="row" id="already-table-form" style="display: none">
		<div class="six columns">
			<h5>Select your table</h5>
			<select name="already-table">
				<option>Dummy table</option>
			</select>
			<h5>Any modification?</h5>
			<textarea name="create-table" placeholder="ALTER TABLE `example`..." rows="10"></textarea>
		</div>
		<div class="six columns">
			<h5>Some help</h5>
			<blockquote>
				ALTER TABLE `example` (<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;`id` int(10) unsigned NOT NULL AUTO_INCREMENT,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;`name` varchar(255) NOT NULL,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;`ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;`ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;PRIMARY KEY (`id`)<br/>
				) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
			</blockquote>
		</div>
	</div>
	<div class="row" id="new-table-form" style="display: none">
		<div class="six columns">
			<h5>Insert here your SQL CREATE TABLE statement</h5>
			<textarea name="create-table" placeholder="CREATE TABLE `example`..." rows="10"></textarea>
		</div>
		<div class="six columns">
			<h5>Some help</h5>
			<blockquote>
				CREATE TABLE `example` (<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;`id` int(10) unsigned NOT NULL AUTO_INCREMENT,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;`name` varchar(255) NOT NULL,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;`ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;`ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;PRIMARY KEY (`id`)<br/>
				) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
			</blockquote>
		</div>
	</div>
	<div class="row" id="relationships-form" style="display: none">
		<h5>Relationships</h5>
		<p>
			Define the relationships of this table with other tables to custom your controller.<br/>
			<i>
				In <strong>n-m</strong> relationships, the table that is used to link the to tables implicated, is
				generated automatically. Only select the type and the fields that you will
				link. <strong>Butler do the rest!</strong>.
			</i>
		</p>
		<div class="add-item row collapse">
			<div class="three columns"><input type="text" name="curfield" placeholder="C. Field"/></div>
			<div class="three columns"><input type="text" name="reltable" placeholder="R. Table"/></div>
			<div class="three columns"><input type="text" name="relfield" placeholder="R. Field"/></div>
			<div class="two columns">
				<select name="type">
					<option value="single">1 to 1</option>
					<option value="multiple">n to m</option>
				</select>
			</div>
			<div class="one columns">
				<span class="postfix">
					<a href="#" id="add-relationship"><span class="general foundicon-plus"/></a>
				</span>
			</div>		
		</div>
		<table id="relationships" class="twelve">
			<tr>
				<th>C. Field</th>			
				<th>R. Table</th>
				<th>R. Field</th>
				<th>Type</th>
				<th></th>
			</tr>
			<tr>
				<td class="cfield">id_dummy</td>
				<td class="rtable">dummy_table</td>
				<td class="rfield">id_dummy</td>
				<td class="type">1 to 1</td>
				<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>
			</tr>		
			<tr>
				<td class="cfield">id_dummy</td>
				<td class="rtable">dummy_table</td>
				<td class="rfield">id_dummy</td>
				<td class="type">1 to 1</td>
				<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>
			</tr>	
			<tr>
				<td class="cfield">id_dummy</td>
				<td class="rtable">dummy_table</td>
				<td class="rfield">id_dummy</td>
				<td class="type">1 to 1</td>
				<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>
			</tr>	
		</table>	
		<a href="#" class="medium button right" id="generate">Generate</a>
	</div>
</div>