<?php
$databases_json = Fw_Register::getRef('databases_json');
?>
<script type="text/javascript">
	var databases_json = <?php echo $databases_json ?>;
	$(document).ready(function(){
		$('span.delete').live('click',function(){			
			if(confirm('Are you shure that you would delete this item?')){
				$(this).parents().filter('div.instance').remove();
			}
		});
		$('span.add').live('click',function(){
			addInstance($(this).parents().filter('div.add-item').children().filter('input[name=instance]').val());			
		});		
		$('#save').live('click',function(){
			var content = '';
			$('div.instance').each(function(){
				content += '['+$(this).children().filter('h3').text()+']'+"\n";				
				content +='engine = '		+$(this).children().find('input[name=engine]').val()+"\n";
				content +='host = '			+$(this).children().find('input[name=host]').val()+"\n";
				content +='database = '	+$(this).children().find('input[name=database]').val()+"\n";
				content +='user = '			+$(this).children().find('input[name=user]').val()+"\n";
				content +='pass = '			+$(this).children().find('input[name=pass]').val()+"\n";				
				content += "\n";
			});
			$.ajax({
				type:"POST",
				url:'<?php echo Fw_Router::getUrl("admin", "ajax") ?>',
				data:{'action':'databases', 'content':content},
				dataType:'json',
				success: function(data){
					alert(data['response']);
				}
			});			
		});
		function addInstance(name, values){			
			values					= (typeof values != "undefined")?values:{};			
			values.engine		= (typeof values.engine		!= "undefined")?values.engine		:'';
			values.host			= (typeof values.host			!= "undefined")?values.host			:'';
			values.database	= (typeof values.database	!= "undefined")?values.database	:'';
			values.user			= (typeof values.user			!= "undefined")?values.user			:'';
			values.pass			= (typeof values.pass			!= "undefined")?values.pass			:'';
			var div = '';
			div += '<div class="instance">';
			div += '<h3 style="display:inline-block">'+name+'</h3>';
			div += '<a href="#"><span class="delete instance"/></a>';
			div += '<div>';
			div += '	<ul class="database_instance">';
			div += '		<li>';
			div += '			<label for="engine"><span class="config"/>Engine:</label>';
			div += '			<input type="text" name="engine" placeholder="mysql" value="'+values.engine+'"/>';
			div += '		</li>';
			div += '		<li>';
			div += '			<label for="host"><span class="server"/>Host:</label>';
			div += '			<input type="text" name="host" placeholder="127.0.0.1" value="'+values.host+'"/>';
			div += '		</li>';
			div += '		<li>';
			div += '			<label for="database"><span class="database"/>Database:</label>';
			div += '			<input type="text" name="database" placeholder="butler" value="'+values.database+'"/>';
			div += '		</li>';
			div += '		<li>';
			div += '			<label for="user"><span class="user"/>User:</label>';
			div += '			<input type="text" name="user" placeholder="myuser" value="'+values.user+'"/>';
			div += '		</li>';
			div += '		<li>';
			div += '			<label for="pass"><span class="key"/>Password:</label>';
			div += '			<input type="text" name="pass" placeholder="mypass" value="'+values.pass+'"/>';
			div += '		</li>';
			div += '	</ul>';
			div += '</div>';		
			div += '</div>';
			$('#database_instances').append(div);
		}
		$.each(databases_json, function(instance, values){
			console.log(values);
			addInstance(instance, values);
		});
	});
</script>
<div id="configuration">
	<h2>Configuration</h2>
	<div class="add-item">
		<input type="text" name="instance" placeholder="Ex: Local"/>
		<a href="#"><span class="add"/></a>
	</div>
	<div id="database_instances"></div>
</div>
<a href="#" class="submit btn-form" id="save">Save</a>