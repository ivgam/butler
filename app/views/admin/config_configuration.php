<?php
$config_json = Fw_Register::getRef('config_json');
?>
<script type="text/javascript">
	var config_json = <?php echo $config_json ?>;
	$(document).ready(function(){
		$('span.delete').live('click',function(){			
			if(confirm('Are you shure that you would delete this item?')){
				if($(this).hasClass('var')){
					$(this).parents().filter('tr').remove();				
				}
				else if($(this).hasClass('instance')){
					$(this).parents().filter('li.instance').remove();
				}
			}
		});
		$('span.add').live('click',function(){			
			if($(this).hasClass('var')){
				var name = $(this).parents().filter('div.add-item').children().find('input[name=var]').val();
				var value = $(this).parents().filter('div.add-item').children().find('input[name=value]').val();
				var instance = $(this).parents().filter('li.instance').children().find('table').attr('id');
				addVar(name,value,instance);
			}
			else if($(this).hasClass('instance')){
				addInstance($(this).parents().filter('div.add-item').children().find('input[name=instance]').val());
			}
		});		
		$('#save').live('click',function(){
			var content = '';
			$('li.instance').each(function(){
				var instance = $(this).children().find('table').attr('id');				
				content += '['+instance+']'+"\n";
				$($(this).children().find('table').children().find('td.var')).each(function(){
					var name = $(this).text();
					var value = $(this).parent().children().filter('td.value').text();
					content += name+' = '+value+"\n";
				});
				content += "\n";
			});			
			$.ajax({
				type:"POST",
				url:'<?php echo Fw_Router::getUrl("admin", "ajax") ?>',
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
			tr +='<span class="general foundicon-remove right delete var"/>';
			tr +='</a>';
			tr +='</tr>';
			tr += '</tr>';			
			$('table#'+instance).append(tr);
		}
		function addInstance(name){
			var div = '';
			div += '<li class="instance">';
			div += '<div class="panel">';
			div += '<h5>';
			div += name;
			div += '<a href="#"><span class="general foundicon-remove right delete instance"/></a>';
			div += '</h5>';
			div += '<div class="add-item row collapse">';
			div += '	<div class="two columns"><span class="prefix">Var</span></div>';
			div += '  <div class="three columns">';
			div += '		<input type="text" name="var" placeholder="Ex: MyVar"/>';
			div += '	</div>';
			div += '	<div class="two columns"><span class="prefix">Value</span></div>';
			div += '  <div class="three columns">';
			div += '		<input type="text" name="value" placeholder="Ex: 1234"/>';
			div += '	</div>'; 
			div += '	<div class="two columns">'; 
			div += '		<span class="postfix">'; 
			div += '			<a href="#"><span class="general foundicon-plus add var"></span></a>'; 
			div += '		</span>'; 
			div += '	</div>'; 
			div += '</div>';
			div += '<table id="'+name+'" class="twelve">';
			div += '	<tr>';
			div += '		<th>Var</th>';
			div += '		<th>Value</th>';
			div += '		<th></th>';
			div += '	</tr>';
			div += '</table>';
			div += '</div>'; 
			div += '</li>';
			$('#instances').append(div);
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
	<h4>Configuration</h4>
	<div class="row add-item collapse">								
		<div class="four columns">
			<div class="ten columns">
				<input type="text" name="instance" placeholder="Ej: Local"/>
			</div>
			<div class="two columns">
				<span class="postfix">
					<a href="#"><span class="general foundicon-plus add instance"></a>
				</span>
			</div>
		</div>
	</div>
	<ul id="instances" class="block-grid three-up mobile"></ul>
</div>
<a href="#" class="medium button" id="save">Save</a>