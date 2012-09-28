<?php 
	$config_json = Fw_Register::getRef('config_json');
?>
<script type="text/javascript">
	var config_json = <?php echo $config_json?>;
	$(document).ready(function(){
		$('span.delete').live('click',function(){			
			if(confirm('Are you shure that you would delete this item?')){
				if($(this).hasClass('var')){
					$(this).parents().filter('tr').remove();				
				}
				else if($(this).hasClass('instance')){
					$(this).parents().filter('div.instance').remove();
				}
			}
		});
		$('span.add').live('click',function(){
			if($(this).hasClass('var')){
				var name = $(this).parents().filter('div.add-item').children().filter('input[name=var]').val();
				var value = $(this).parents().filter('div.add-item').children().filter('input[name=value]').val();
				var instance = $(this).parents().filter('div.instance').children().filter('table').attr('id');
				addVar(name,value,instance);
			}
			else if($(this).hasClass('instance')){
				addInstance($(this).parents().filter('div.add-item').children().filter('input[name=instance]').val());
			}
		});		
		$('#save').live('click',function(){
			var content = '';
			$('div.instance').each(function(){
				var instance = $(this).children().filter('table').attr('id');				
				content += '['+instance+']'+"\n";
				$($(this).children().filter('table').children().find('td.var')).each(function(){
					var name = $(this).text();
					var value = $(this).parent().children().filter('td.value').text();
					content += name+' = '+value+"\n";
				});
				content += "\n";
			});
			$.ajax({
				type:"POST",
				url:'<?php echo Fw_Router::getUrl("admin","ajax")?>',
				data:{'action':'configuration', 'content':content},
				dataType:'json',
				success: function(data){
					alert(data['response']);
				}
			});			
		});	
		function addVar(name,value,instance){
			var tr = '<tr>';			
				tr += '<td class="var">'+name+'</td>';			
				tr += '<td class="value">'+value+'</td>';			
				tr +='<td>';
				tr +='<a href="#" title="delete">';
				tr +='<span class="delete var"/>';
				tr +='</a>';
				tr +='</tr>';
				tr += '</tr>';			
			$('table#'+instance).append(tr);
		}
		function addInstance(name){
			var div = '';
				div += '<div class="instance">';
				div += '<h3 style="display:inline-block">';
				div += name;
				div += '</h3>';
				div += '<a href="#"><span class="delete instance"/></a>';
				div += '<div class="add-item">';
				div += '	<input type="text" name="var" placeholder="Ex: MyVar"/>';
				div += '	<input type="text" name="value" placeholder="Ex: 1234"/>';
				div += '	<a href="#"><span class="add var"></span>';
				div += '</div>';
				div += '<table class="minify" id="'+name+'">';
				div += '	<tr>';
				div += '		<th class="highlight">Var</th>';
				div += '		<th class="highlight">Value</th>';
				div += '		<th class="highlight"></th>';
				div += '	</tr>';
				div += '</table>';
				div += '</div>';
			$('#configuration').append(div);
		}
		$.each(config_json, function(instance, vars){
			addInstance(instance);			
			$.each(vars, function(name, value){
				addVar(name,value,instance);
			});
		});
	});
</script>
<div id="configuration">
	<h2>Configuration</h2>
	<div class="add-item">
		<input type="text" name="instance" placeholder="Ex: Local"/>
		<a href="#"><span class="add instance"/></a>
	</div>
</div>
<a href="#" class="submit btn-form" id="save">Save</a>