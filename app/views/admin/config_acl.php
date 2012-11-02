<?php
$acl_raw = Fw_Register::getRef('acl_raw');
$controllers_list = Fw_Register::getRef('controllers_list');
?>
<script type="text/javascript">	
	var resource_methods = {};
	$(document).ready(function(){
		$('span.delete').live('click',function(){
			if(confirm('Are you shure that you would delete this item?')){
				$(this).parents().filter('tr').remove();
				init();
			}
		});
		$('#add-role').live('click',function(){
			var role = $(this).parents().filter('div.add-item').children().find('input[name=name]').val();
			var parent = $(this).parents().filter('div.add-item').children().find('select[name=role]').val();
			var tr  ='<tr>';
			tr +='<td class="name">';
			tr +=role;
			tr +='</td>';
			tr +='<td class="parent">';
			tr += parent;
			tr +='</td>';			
			tr +='<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>';			
			tr +='</tr>';
			$('#roles').append(tr);
			updateRoleSelect();
		});
		$('#add-resource').live('click',function(){			
			var resource = $(this).parents().filter('div.add-item').children().find('input[name=resource]').val();						
			var tr  ='<tr>';
			tr +='<td class="resource">';
			tr +=resource;
			tr +='</td>';			
			tr +='<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>';			
			tr +='</tr>';
			$('#resources').append(tr);
			updateSubresourcesSelect();
			updateResourceMethods();
			updateResourceSelect();
		});
		$('#add-permission').live('click',function(){
			var role = $(this).parents().filter('div.add-item').children().find('select[name=role]').val();
			var resource = $(this).parents().filter('div.add-item').children().find('select[name=resource]').val();			
			var method = $(this).parents().filter('div.add-item').children().find('select[name=method]').val();			
			var access = $(this).parents().filter('div.add-item').children().find('select[name=access]').val();			
			var tr  ='<tr>';
			tr +='<td class="role">';
			tr +=role;
			tr +='</td>';
			tr +='<td class="resource">';
			tr +=resource;
			tr +='</td>';
			tr +='<td class="method">';
			tr +=method;
			tr +='</td>';
			tr +='<td class="access">';
			tr +=access;
			tr +='</td>';			
			tr +='<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>';			
			tr +='</tr>';
			$('#permissions').append(tr);
			updateSubresourcesSelect();
		});
		$('#permission_resource').live('change', function(){
			updateMethodSelect();
		});
		$('#save').live('click',function(){
			saveACL();
		});
		init();
		function saveACL(){
			var roles = getRoles();
			var resources = getResources();
			var subresources = getSubresources();
			var permissions = getPermissions();
			var acl = roles+"\n"+resources+"\n"+subresources+"\n"+permissions;			
			$.ajax({
				type:"POST",
				url:'<?php echo Fw_Router::getUrl("admin", "ajax") ?>',
				data:{'action':'acl', 'content':acl},
				dataType:'json',
				success: function(data){
					alert(data['response']);
				}
			});
		}
		function getRoles(){
			var to_return = "[roles]\n";
			$('#roles tr td.name').each(function(){
				to_return += $(this).text()+' = "'+$(this).parent().children().find('td.parent').text()+'"'+"\n";				
			});
			return to_return;
		}
		function getResources(){
			var to_return = "[resources]\n";
			$('#resources tr td.resource').each(function(){
				to_return += $(this).text()+" = null\n";				
			});
			return to_return;
		}
		function getSubresources(){
			var to_return = "[subresources]\n";
			$('ul.controllers li span.prefix').each(function(){
				to_return += $(this).text().replace(':','')+' = "'+$(this).parents().filter('li').children().find('select').val()+'"'+"\n";				
			});
			return to_return;
		}
		function getPermissions(){
			var to_return = '';
			$('#roles tr td.name').each(function(){
				var crole = $(this).text();
				to_return += '['+crole+']'+"\n";				
				$('#permissions tr td.role').each(function(){
					if($(this).text()==crole){
						var resource = $(this).parent().children().filter('td.resource').text();
						var method = $(this).parent().children().filter('td.method').text();
						var access = $(this).parent().children().filter('td.access').text();
						to_return += crole+'.'+resource+'.'+method+' = '+access+"\n";				
					}
				})				
			});
			return to_return;
		}
		function init(){
			resource_methods = <?php echo json_encode($controllers_list) ?>;
			updateRoleSelect();
			updateSubresourcesSelect();
			updateResourceMethods();	
			updateResourceSelect();		
			filterValidPermissions();
		}
		function updateSubresourcesSelect(){
			$('select[name^=controller-]').html('');			
			$('#resources tr td.resource').each(function(){				
				var option = '<option value="'+$(this).text()+'">'+$(this).text()+'</option>';			
				$('select[name^=controller-]').append(option);						
			});
			setDefaultSubresourcesValue();
		}
		function setDefaultSubresourcesValue(){
			<?php foreach ($acl_raw['subresources'] as $controller => $resource) { ?>
				$('select[name=controller-<?php echo $controller ?>]').val('<?php echo $resource ?>');
			<?php } ?>
		}
		function updateResourceSelect(){
			$('#permission_resource').html('');
			$.each(resource_methods, function(k,v){
				var option = '<option value="'+k+'">'+k+'</option>';
				$('#permission_resource').append(option);
			});
			updateMethodSelect();
		}
		function updateMethodSelect(){
			$('#permission_method').html('');
			$.each(resource_methods[$('#permission_resource').val()], function(k,v){				
				var option = '<option value="'+v+'">'+v+'</option>';
				$('#permission_method').append(option);
			});
			var option = '<option value="all">all</option>';
			$('#permission_method').append(option);
		}
		function updateRoleSelect(){
			$('select[name=role]').html('');
			$('#parent_role').html('<option value="">No Parent</option>');
			$('#roles tr td.name').each(function(){
				var option = '<option value="'+$(this).text()+'">'+$(this).text()+'</option>';
				$('select[name=role]').append(option);				
			});
		}
		function updateResourceMethods(){
			$('#resources tr td.resource').each(function(){
				resource_methods[$(this).text()] = [];
			});
		}
		function filterValidPermissions(){
			$('#permissions tr td.role').each(function(){
				var prole = $(this).text();
				var role_exists = false;
				$('#roles tr td.name').each(function(){
					if($(this).text() == prole){ 
						role_exists = true;
						return;
					}							
				});
				if(!role_exists){
					$(this).parent().remove();
				}
			});
			$('#permissions tr td.resource').each(function(){
				var presource = $(this).text();
				var resource_exists = false;
				$.each(resource_methods, function(k,v){
					if(k == presource){ 
						resource_exists = true;
						return;
					}							
				});
				if(!resource_exists){
					$(this).parent().remove();
				}
			});
		}
	});
</script>
<div class="config">
	<div class="row">	
		<div class="nine columns centered">
			<div class="row">
				<div class="five columns">
					<h4>1. Roles</h4>				
					<div class="row add-item collapse">
						<div class="six columns">
							<input type="text" name="name" placeholder="Ej: Guest"/>
						</div>
						<div class="four columns">
							<select name="role" id="parent_role">
								<option>No Parent</option>
							</select>
						</div>				
						<div class="two columns">
							<span class="postfix">
								<a href="#" id="add-role"><span class="general foundicon-plus"></a>
							</span>
						</div>				
					</div>
					<table id="roles" class="twelve">
						<tr>		
							<th>Name</th>			
							<th>Parent</th>
							<th></th>
						</tr>
						<?php foreach ($acl_raw['roles'] as $role => $parent) { ?>
							<tr>
								<td class="name"><?php echo $role ?></td>
								<td class="parent"><?php echo $parent ?></td>
								<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>
							</tr>
						<?php } ?>
					</table>				
				</div>
				<div class="two columns"></div>
				<div class="five columns">
					<h4>2. Resources</h4>				
					<div class="row add-item">						
						<div class="row collapse">
							<div class="ten columns">
								<input type="text" name="resource" placeholder="Ej: Static"/>
							</div>
							<div class="two columns">
								<span class="postfix">
									<a href="#" id="add-resource"><span class="general foundicon-plus"></a>
								</span>
							</div>
						</div>						
					</div>
					<div class="row">
						<table id="resources" class="twelve">
							<tr>			
								<th>Name</th>			
								<th></th>
							</tr>
							<?php foreach ($acl_raw['resources'] as $name => $void) { ?>
								<tr>
									<td class="resource"><?php echo $name ?></td>			
									<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>
								</tr>
							<?php } ?>
						</table>				
					</div>
				</div>			
			</div>
			<div class="row">
				<div class="five columns">
					<h4>3. Subresources</h4>			
					<ul class="block-grid two-up controllers">
						<?php foreach ($controllers_list as $controller => $methods) { ?>					
							<li>
								<div class="row collapse">
									<div class="four columns">
										<span class="prefix"><?php echo $controller ?></span>
									</div>
									<select name="controller-<?php echo $controller ?>" class="eight"></select>					
								</div>
							</li>
						<?php } ?>			
					</ul>
				</div>			
				<div class="two columns"></div>
				<div class="five columns">
					<h4>4. Permissions</h4>			
					<div class="add-item row collapse">			
						<div class="two columns"><select name="role"></select></div>
						<div class="three columns"><select name="resource" id="permission_resource"></select></div>
						<div class="three columns"><select name="method" id="permission_method"></select></div>
						<div class="two columns">
							<select name="access">
								<option value="allow">allow</option>
								<option value="allow">deny</option>
							</select>
						</div>
						<div class="two columns">
							<span class="postfix">
								<a href="#" id="add-permission"><span class="general foundicon-plus"></a>
							</span>
						</div>			
					</div>
					<table id="permissions" class="twelve">
						<tr>
							<th>Role</th>			
							<th>Resource</th>
							<th>Method</th>
							<th>Access</th>
							<th></th>
						</tr>
						<?php
						foreach ($acl_raw['roles'] as $role => $parent) {
							foreach ($acl_raw[$role] as $chain => $access) {
								list($role, $resource, $method) = explode('.', $chain);
								?>
								<tr>
									<td class="role"><?php echo $role ?></td>
									<td class="resource"><?php echo $resource ?></td>
									<td class="method"><?php echo $method ?></td>
									<td class="access"><?php echo $access ?></td>
									<td><a href="#"	title="delete"><span class="general foundicon-remove right"/></a></td>
								</tr>
								<?php
							}
						}
						?>						
					</table>			
				</div>
			</div>
			<div class="row"><a href="#" class="medium button right" id="save">Save</a></div>
		</div>
	</div>
</div>