<?php
$databases_json = Fw_Register::getRef('databases_json');
?>
<script type="text/javascript">
	var databases_json = <?php echo $databases_json ?>;
	$(document).ready(function(){
		$('span.delete').live('click',function(){			
			if(confirm('Are you shure that you would delete this item?')){
				$(this).parents().filter('li.instance').remove();
			}
		});
		$('#add-instance').live('click',function(){
			addInstance($(this).parents().filter('div.add-item').children().find('input[name=instance]').val());			
		});		
		$('#save').live('click',function(){
			var content = '';
			$('li.instance').each(function(){
				content += '['+$(this).children().find('h5').text()+']'+"\n";				
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
			values					= (typeof values					!= "undefined")?values:{};			
			values.engine		= (typeof values.engine		!= "undefined")?values.engine		:'';
			values.host			= (typeof values.host			!= "undefined")?values.host			:'';
			values.database	= (typeof values.database	!= "undefined")?values.database	:'';
			values.user			= (typeof values.user			!= "undefined")?values.user			:'';
			values.pass			= (typeof values.pass			!= "undefined")?values.pass			:'';
			var div = '';
			div += '<li class="instance">';
			div += '<div class="panel">';
			div += '<h5>';
			div += name;
			div += '<a href="#"><span class="general foundicon-remove right delete"/></a>';
			div += '</h5>';
			div += '<div>';
			div += '	<div class="database_instance">';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">Engine</span></div>';
			div += '			<input class="eight" type="text" name="engine" placeholder="mysql" value="'+values.engine+'"/>';
			div += '		</div>';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">Host</span></div>';
			div += '			<input class="eight" type="text" name="host" placeholder="127.0.0.1" value="'+values.host+'"/>';
			div += '		</div>';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">Database</span></div>';
			div += '			<input class="eight"type="text" name="database" placeholder="butler" value="'+values.database+'"/>';
			div += '		</div>';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">User</span></div>';
			div += '			<input class="eight" type="text" name="user" placeholder="myuser" value="'+values.user+'"/>';
			div += '		</div>';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">Password</span></div>';
			div += '			<input class="eight" type="text" name="pass" placeholder="mypass" value="'+values.pass+'"/>';
			div += '		</div>';
			div += '	</div>';
			div += '</div>';		
			div += '</div>';		 
			div += '</li>';
			$('#database_instances').append(div);
		}
		$.each(databases_json, function(instance, values){			
			addInstance(instance, values);
		});
	});
</script>
<div id="configuration">
	<h4>Configuration</h4>
		<div class="row add-item collapse">								
		<div class="four columns">
			<div class="ten columns">
				<input type="text" name="instance" placeholder="Ej: Local"/>
			</div>
			<div class="two columns">
				<span class="postfix">
					<a href="#" id="add-instance"><span class="general foundicon-plus"></a>
				</span>
			</div>
		</div>
	</div>
	<ul id="database_instances" class="block-grid three-up"></ul>
</div>
<a href="#" class="button medium" id="save">Save</a>