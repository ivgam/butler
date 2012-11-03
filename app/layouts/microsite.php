<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>				
		<?php Fw_Module::getModule('navigation', array('style' => 'topbar-attached')) ?>		
		<div class="container" style="background-color: #ccc">
			<div class="row">
				<div class="twelve columns">				
					<p><img src="http://placehold.it/1920x400&text=[banner img]" /></p>
				</div>
			</div>				
		</div>
		<div class="container" style="margin-top:20px">
			<div class="row">
				<div class="eight columns">
					<h4><i>Lo bueno, si breve, dos veces bueno.</i></h4>
					<blockquote>
						<i>Crea, edita, controla y mejora tu web día a día de manera sencilla y rápida.</i>
					</blockquote> 
					<p>
						Butler pretende ser tu mejor aliado a la hora de afrontar un proyecto web,
						ofreciendo características útiles bajo un precepto muy claro: <strong>la simplicidad</strong>.
					</p>
					<p>
						Para ello, hemos unido aquellas tecnologías que creemos punteras en los diferentes
						campos del mundo web y hemos creado un framework, versátil, ligero y muy fácil
						de utilizar.
					</p>
					<p>
						Butler es divertido, ameno y muy recomendable para todos aquellos que deseen
						programar una página web sin complicarse demasiado la vida, pero sin descuidar
						la escalabilidad o la modularidad de sus aplicaciones.
					</p>					
					<p><a href="#" class="secondary small button">Conoce Butler &rarr;</a></p>
				</div>
				<div class="four columns">				
					<ul class="block-grid three-up">
						<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
						<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
						<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
						<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
						<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
						<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
					</ul>
				</div>
			</div>
		</div>				
		<div class="container">
			<div class="row">

			</div>
		</div>				
		<div class="container" style="background-color: #222; margin:26px 0; padding:20px 0">
			<!-- Call to Action Panel -->
			<div class="row">
				<img src="<?php echo IMG_URI?>technologies.png"/>
			</div>
		</div>
		<div class="container" style="background-color: #444">
			<?php Fw_Module::getModule('footer-microsite'); ?>
		</div>
		<?php Fw_CCC::getAllFrontJs() ?>
	</body>
</html>
