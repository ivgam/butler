<?php
$oResult = Fw_Register::getRef('oResult');
$sizes = Fw_Register::getRef('sizes');
$resource = Fw_Register::getRef('current_resource');
$resource_name = Fw_Register::getRef('resource_name');
$resource_name = (empty($resource_name))?$resource:$resource_name;
$aImages = Image_Helper::getImages($resource_name, $oResult['id']);
?>
<style>
	#image-list-container .selected
	{
		border-color: rgba(82, 168, 236, 0.8);
		outline: 0;
		outline: thin dotted \9;
		/* IE6-9 */

		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
		-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
	}
	/* IMAGES */
	.remove-image{cursor:pointer}

</style>
<h3>Upload Images: <?= $oResult['name'] ?></h3>
<div class="row">
	<div class="span12">
		<div class="control-group">
			<div class="control-label">
				<label>Select your images</label>
			</div>
			<div class="controls">
				<input type="file" id="images" name="images" multiple="multiple" accept="image/jpg">
				<a href="#" id="images-upload" class="btn btn-primary btn-large">Upload</a>
				<a href="#" id="images-save" class="btn btn-success btn-large">Save</a>
			</div>
		</div>
		<div class="row" id="image-list-container" style="display:none">
			<h5>
				<strong>Image preview:</strong>
				<small>Click in anyone to change the default image</small>
			</h5>
		</div>
	</div>
</div>
<script type="text/javascript">
	number_of_photos = 0;
	function uploadFiles(id){
		var to_return = false;
		var filesData = new FormData();
		var input = document.getElementById(id);
		var i = 0, len = input.files.length, reader, file;
		var numFiles = 0;
		for ( ; i < len; i++ ) {
			file = input.files[i];
			if(file.type == 'image/jpeg'){
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.readAsDataURL(file);
				}
				if (filesData) {
					filesData.append("attachments[]", file);
				}
				numFiles++;
			}
		}
		if(numFiles > 0){
			$.ajax({
				url: '/ajax/upload',
				type: "POST",
				data: filesData,
				processData: false,
				contentType: false,
				async: true,
				dataType: 'json',
				success: function(data){
					if(data.files.length == 0){
						alert('Any image check the image size and ratio conditions');
					}
					$.each(data.files, function(k,v){
						var html = '<div class="span4">';
						html +='<i class="remove-image icon icon-trash"></i>';
						html +='<img style="width:100%" class="image img-polaroid '+((number_of_photos == 0)?'selected':'')+'" src="'+v.resized['product_grid'].url+'"/></div>';
						$('#image-list-container').append(html);
						number_of_photos++;
					});
					if(number_of_photos > 1){
						$('#image-slider-nav').css('display','block');
					}
					$('#image-slider').carousel();
					$('#image-slider-container').css('display','block');
					$('#image-list-container').css('display','block');
					to_return = data;
				}
			});
		} else {
			alert('You don\'t select any correct file. Please, put image/jpeg and then try again.')
		}
		return to_return;
	}
	function save(){
		$.ajax({
			url: '/ajax/setImages',
			type: "POST",
			data: {
				'resource':'<?= $resource_name ?>',
				'id':<?= $oResult['id'] ?>,
				'images': getImages()
			},
			async: true,
			dataType: 'json',
			success: function(data){
				console.log('hola');
				window.location.href = '<?= Fw_Router::getUrl($resource, 'admin');?>';
			}
		});
	}
	
	function getImages(){
		var images = {};
		var index = 0;
		$('#image-list-container img').each(function(){
			images[index++] = {
				'url':$(this).attr('src').replace('_product_grid.jpg', '.jpg'),
				'selected':$(this).hasClass('selected')
			};
		});
		return images;
	}
	function setImages(images){
		$.each(images, function(k,v){
			var html = '<div class="item'+((number_of_photos == 0)?' active':'')+'"><img src="'+v[0].url+'"/></div>';
			$('#image-slider div.carousel-inner').append(html);
			var html = '<div class="span4">';
			html +='<i class="remove-image icon icon-trash"></i>';
			html +='<img style="width:100%" class="image img-polaroid '+((number_of_photos == 0)?'selected':'')+'" src="'+v[0].url+'"/></div>';
			$('#image-list-container').append(html);
			number_of_photos++;
		});
		if(number_of_photos > 1){
			$('#image-slider-nav').css('display','block');
			$('#image-slider').carousel();
		}
		if(number_of_photos > 0){
			$('#image-slider-container').css('display','block');
			$('#image-list-container').css('display','block');
		}
	}

	function setEvents(){	
	
		$('#images-upload').on('click',function(){
			uploadFiles('images');
		});
		
		$('#images-save').on('click',function(){
			save();
		});
		
		$(document).on('click','.image', function(){
			$('.image').removeClass('selected');
			$(this).addClass('selected');
		});
	
		$(document).on('click','.remove-image',function(event){
			//TODO: Check remove more than one image because is the same src (more or less)
			event.preventDefault();
			if(confirm('Are you sure that you want to delete this image?')){
				var src = $(this).parents('div.span4').find('img').attr('src');
				<?php foreach ($sizes as $name => $dimensions) { ?>
				src = src.replace('_<?= $name ?>.jpg', '');
				<?php } ?>
				src = src.replace('.jpg', '');
				$('#image-list-container div.span4 img[src*="'+src+'"]').parents('div.span4').remove();
				$('#image-slider div.item img[src*="'+src+'"]').parents('div.item').remove();
				number_of_photos--;
				if(number_of_photos <= 1){
					$('#image-slider-nav').css('display','none');
				} else {
					$('#image-slider').carousel();
				}
				if(number_of_photos == 0){
					$('#image-slider-container').css('display','none');
					$('#image-list-container').css('display','none');
				} else {
					$('#image-slider-container').css('display','block');
					$('#image-list-container').css('display','block');
				}
			}
		});
		
	}
	
	$(document).ready(function(){
		var images = <?= json_encode($aImages)?>;
		setImages(images);
		setEvents();
	});

</script>
