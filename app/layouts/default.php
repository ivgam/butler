<!DOCTYPE html>
<html>
	<?php Fw_Module::getModule('head'); ?>
	<style>
		html{
			/*background: url('public/images/gplaypattern.png');*/
			background: url('<?php echo IMG_URI?>random_grey_variations.png');
		}
		body{
			padding:0;		
			margin:0;
			color:#ccc;
			background: none;
			font:13px;
		}
		p{
			line-height: 2;
			font-size: 16px;
		}
		#content{
			background-color: white;
			color:#555;
		}		
		#content .title{
			padding: 50px 0px 5px 35px;
		}
		#content p{
			padding:15px 35px;
		}
		#navigation{
			background-color:white;
			color: #333;
		}
		#navigation{
			padding: 35px 0px 50px 35px;
		}
		#navigation li{
			font-size: 22px;			
			padding-bottom:5px;
		}
		#navigation li ul{
			margin-top: 15px;
		}
		#footer{
			margin-top:100px;
			background-color: #222;
			min-height:300px;
		}
		a.current{
			text-decoration: underline;
		}
		.says{
			margin-left:3%;
			font-size: 18px;
			font-weight: bold;			
		}
		.date{
			margin-left:10%;			
		}
		#comments{
			background-color: white;
			color:#333;
		}
		.comment{
			margin:20px 10px 10px 10px;			
			font-style: italic;
		}
		.comment p{
			margin-top:10px;
		}
		.recommended-site{
			width:150px;
			margin-right:15px;
		}
		#solicite-your-post input{

		}
		#solicite-your-post textarea{
			width: 100%;
			height:200px;
		}
		#solicite-your-post input, #solicite-your-post label,
		#solicite-your-post textarea {
			display:block;
			font-size: 14px;
			margin-top:10px;
		}
	</style>
    <body class="home blog">    	
    	<?php Fw_Module::getModule('header'); ?>
    	<div class="row" id="main">
    		<div class="grid_2">
    			<ul id="navigation">
    				<li>
    					<a href="#" class="current">Coding</a>
    					<ul>
    						<li><a href="#">PHP</a></li>
    						<li><a href="#" class="current">JS</a></li>
    						<li><a href="#">CSS</a></li>
    					</ul>
    				</li>
    				<li><a href="#">Patterns</a></li>
    				<li><a href="#">Inspiring</a></li>
    				<li><a href="#">Labs</a></li>
    				<li><a href="#">About Us</a></li>
    			</ul>
    		</div>
    		<div class="grid_7" id="content">
    			<h2 class="title">Lorem Ipsum</h2>
    			<?php echo $html ?>    			
    		</div>
    		<div class="grid_3" id="comments">
    			<h3 style="font-size:35px; margin-top:20px; margin-left:15px">Best Comments</h3>
    			<div>
    				<ul>
    					<li>
    						<div class="comment">    							
    							<img src="http://gravatar.com/avatar/9487110d28486833c5a798b802c6c3aa" height="50px" width="50px"/>
    							<span class="says">Tamara says:</span><span class="date">2012-09-10 11:23:41</span>
    							<p>
    								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    								Donec eget ipsum eu arcu molestie placerat at vel mi. 
    								Curabitur id ante non nisl consectetur suscipit vel sit amet orci. 
    								Sed quis nisi ante, at euismod nibh. In placerat porttitor facilisis.
    							</p>
    						</div>
    					</li>
    					<li>
    						<div class="comment">    							
    							<img src="http://gravatar.com/avatar/9487110d28486833c5a798b802c6c3aa" height="50px" width="50px"/>
    							<span class="says">Tamara says:</span><span class="date">2012-09-10 11:23:41</span>
    							<p>
    								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    								Donec eget ipsum eu arcu molestie placerat at vel mi. 
    								Curabitur id ante non nisl consectetur suscipit vel sit amet orci. 
    								Sed quis nisi ante, at euismod nibh. In placerat porttitor facilisis.
    							</p>
    						</div>
    					</li>
    					<li>
    						<div class="comment">    							
    							<img src="http://gravatar.com/avatar/9487110d28486833c5a798b802c6c3aa" height="50px" width="50px"/>
    							<span class="says">Tamara says:</span><span class="date">2012-09-10 11:23:41</span>
    							<p>
    								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    								Donec eget ipsum eu arcu molestie placerat at vel mi. 
    								Curabitur id ante non nisl consectetur suscipit vel sit amet orci. 
    								Sed quis nisi ante, at euismod nibh. In placerat porttitor facilisis.
    							</p>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</div>
    	</div>    	
		<?php Fw_Module::getModule('footer'); ?>
	</body>
</html>