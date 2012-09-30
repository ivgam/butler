<?php
$routes_json = Fw_Register::getRef('routes_json');
$controllers_list = Fw_Register::getRef('controllers_list');
?>
<script type="text/javascript">
	var controllers_list = <?php echo json_encode($controllers_list)?>;
	function getControllersSelect(controller){
		var content = '<select name="controller">';
		$.each(controllers_list, function(k,v){
			name = k.charAt(0).toUpperCase() + k.slice(1) + '_Controller';
			content += '<option value="'+name+'" '+((name==controller)?'selected="selected"':'')+'>'+k+'</option>';
		});
		content += '</select>';
		return content;
	}
	function getTasksSelect(controller,task){
		var content = '<select name="task">';
		$.each(controllers_list, function(k,v){
			c = k.charAt(0).toUpperCase() + k.slice(1) + '_Controller';
			if(c == controller){
				content += '<option value=""></option>';				
				$.each(v, function(i,t){			
					content += '<option value="'+t+'" '+((task==t)?'selected="selected"':'')+'>'+t+'</option>';				
				});
			}
		});
		content += '</select>';
		return content;
	}
	var routes_json = <?php echo $routes_json ?>;		
	$(document).ready(function(){
		$('span.delete').live('click',function(){			
			if(confirm('Are you shure that you would delete this item?')){
				$(this).parents().filter('div.route').remove();
			}
		});
		$('span.add').live('click',function(){
			addRoute($(this).parents().filter('div.add-item').children().filter('input[name=route]').val(),{},true);			
		});		
		$('#save').live('click',function(){
			var content = '<'+'?'+'php'+"\n";
			content += "$routes = array ( \n";
			$('div.route').each(function(){				
				content += "\t"+'"'+$(this).children().filter('h3').text()+'"'+' => array ('+"\n";
				content += "\t\t"+'"controller" => "'+$(this).children().find('select[name=controller]').val()+'",'+"\n";
				content += "\t\t"+'"url" => "'+$(this).children().find('input[name=url]').val()+'",'+"\n";
				content += "\t\t"+'"regex" => "/'+($(this).children().find('input[name=url]').val()).replace(/\//g, '\\/')+'/",'+"\n";
				content += "\t\t"+'"params" => array(),'+"\n";
				content += "\t\t"+'"task" => "'+$(this).children().find('select[name=task]').val()+'",'+"\n";
				content += "\t\t"+'"resource" => "'+$(this).children().find('input[name=resource]').val()+'",'+"\n";
				content += "\t\t"+'"cacheable" => '+$(this).children().find('input[name=cacheable]').is(':checked')+"\n";
				content += "\t),\n";
			});
			content += ");\n";
			$.ajax({
				type:"POST",
				url:'<?php echo Fw_Router::getUrl("admin", "ajax") ?>',
				data:{'action':'routes', 'content':content},
				dataType:'json',
				success: function(data){
					alert(data['response']);
				}
			});			
		});
		$('select[name=controller]').live('change',function(){
			$(this).parents().filter('ul.route').children().find('select[name=task]').replaceWith(getTasksSelect($(this).val()), '');
		});
		
		function addRoute(route, values, prepend){			
			values						= (typeof values							!= "undefined")?values:{};			
			values.controller	= (typeof values.controller		!= "undefined")?values.controller		:'';
			values.url				= (typeof values.url					!= "undefined")?values.url					:'';
			values.resource		= (typeof values.resource			!= "undefined")?values.resource			:'';
			values.task				= (typeof values.task					!= "undefined")?values.task					:'';
			values.cacheable	= (typeof values.cacheable		!= "undefined")?values.cacheable		:false;			
			var div = '';
			div += '<div class="route">';
			div += '<h3 style="display:inline-block">'+route+'</h3>';
			div += '<a href="#"><span class="delete instance"/></a>';
			div += '<div>';
			div += '	<ul class="route">';
			div += '		<li>';
			div += '			<label for="controller">Controller:</label>';
			div += '			'+getControllersSelect(values.controller);
			div += '		</li>';
			div += '		<li>';
			div += '			<label for="url">URL:</label>';
			div += '			<input type="text" name="url" placeholder="login" value="'+values.url+'"/>';
			div += '		</li>';
			div += '		<li>';
			div += '			<label for="resource">Resource:</label>';
			div += '			<input type="text" name="resource" placeholder="auth" value="'+values.resource+'"/>';
			div += '		</li>';
			div += '		<li>';
			div += '			<label for="task">Task:</label>';
			div += '			'+getTasksSelect(values.controller, values.task);
			div += '		</li>';
			div += '		<li>';
			div += '			<label for="cacheable">Cacheable:</label>';
			div += '			<input type="checkbox" name="cacheable"'+((values.cacheable)?'checked="checked"':'')+'"/>';
			div += '		</li>';
			div += '	</ul>';
			div += '</div>';		
			div += '</div>';
			if(prepend){
				$('#routes').prepend(div);
			} else {
				$('#routes').append(div);				
			}
		}		
		$.each(routes_json, function(route, values){			
			addRoute(route, values, false);			
		});
	});
</script>
<div id="configuration">
	<h2>Configuration</h2>
	<div class="add-item">
		<input type="text" name="route" placeholder="Ex: Local"/>
		<a href="#"><span class="add"/></a>
	</div>
	<div id="routes"></div>
</div>
<a href="#" class="submit btn-form" id="save">Save</a>