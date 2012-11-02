<?php
$routes_json = Fw_Register::getRef('routes_json');
$controllers_list = Fw_Register::getRef('controllers_list');
?>
<script type="text/javascript">
	var controllers_list = <?php echo json_encode($controllers_list)?>;
	function getControllersSelect(controller){
		var content = '<select class="eight" name="controller">';
		$.each(controllers_list, function(k,v){
			name = k.charAt(0).toUpperCase() + k.slice(1) + '_Controller';
			content += '<option value="'+name+'" '+((name==controller)?'selected="selected"':'')+'>'+k+'</option>';
		});
		content += '</select>';
		return content;
	}
	function getTasksSelect(controller,task){
		var content = '<select class="eight" name="task">';
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
				$(this).parents().filter('li.route').remove();
			}
		});
		$('span.add').live('click',function(){
			addRoute($(this).parents().find('div.add-item').children().find('input[name=route]').val(),{},true);			
		});		
		$('#save').live('click',function(){
			var content = '<'+'?'+'php'+"\n";
			content += "$routes = array ( \n";
			$('li.route').each(function(){				
				content += "\t"+'"'+$(this).children().find('h5').text()+'"'+' => array ('+"\n";
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
			div += '<li class="route">';
			div += '<div class="panel">';
			div += '<h5 style="display:inline-block">'+route+'</h5>';
			div += '<a href="#"><span class="general foundicon-remove right delete"/></a>';
			div += '<div>';
			div += '	<ul class="route">';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">Controller</span></div>';
			div += '			'+getControllersSelect(values.controller);
			div += '		</div>';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">URL</span></div>';
			div += '			<input class="eight" type="text" name="url" placeholder="login" value="'+values.url+'"/>';
			div += '		</div>';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">Resource</span></div>';
			div += '			<input class="eight" type="text" name="resource" placeholder="auth" value="'+values.resource+'"/>';
			div += '		</div>';
			div += '		<div class="row collapse">';
			div += '			<div class="four columns"><span class="prefix">Task</span></div>';
			div += '			'+getTasksSelect(values.controller, values.task);
			div += '		</div>';
			div += '		<div class="row collapse">';
			div += '			<input type="checkbox" name="cacheable"'+((values.cacheable)?'checked="checked"':'')+'"/>';
			div += '			Cacheable';
			div += '		</div>';
			div += '	</ul>';
			div += '</div>';		
			div += '</div>';		
			div += '</li>';
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
	<h4>Configuration</h4>
	<div class="row add-item collapse">								
		<div class="four columns">
			<div class="ten columns">
				<input type="text" name="route" placeholder="Ej: Local"/>
			</div>
			<div class="two columns">
				<span class="postfix">
					<a href="#" id="add instance"><span class="general foundicon-plus add"></a>
				</span>
			</div>
		</div>
	</div>
	<ul id="routes" class="block-grid three-up"></ul>
</div>
<div class="row"><a href="#" class="medium button" id="save">Save</a></div>