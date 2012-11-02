<div class="container top-bar home-border">
	<div class="attached">
		<div class="name">
			<span style="width:160px">
				<a href="#" class="logo-white" style="width:150px"></a> 
				<a href="#" class="toggle-nav"></a>
			</span>
		</div>
		<ul class="right">
			<li>
				<a href="<?php echo BASE_URI ?>" target="_blank" title="Go to Web">
					<span class="general foundicon-globe"></span>
				</a>
			</li>
			<li>
				<a href="<?php echo Fw_Router::getUrl('auth', 'logout') ?>" title="Logout">
					<span class="general foundicon-unlock"></span>
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="container" id="megaDrop" style="display: none; ">
  <div class="mobile-main-nav-padding">
    <div class="row top">
      <div class="eight columns">
        <a href="#"><h4>Advanced Administration</h4></a>
      </div>
      <div class="four columns">
        <div class="right links">
          <a href="#">Wiki</a> | <a href="#">News </a> | <a href="#">Contact</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="tablet-padding">
        <div class="three columns property">
          <a href="<?php echo Fw_Router::getUrl('config', 'config_acl') ?>">
            <h4>ACL</h4>
            <p>
							Configura tu ACL(Access Control List) para lograr una mayor flexibilidad de uso de tu 
							aplicación o site. Crea roles, recursos y asigna permisos.
            </p>
            <span>Configurar ACL →</span>
          </a>
        </div>
        <div class="three columns property">
          <a href="<?php echo Fw_Router::getUrl('config', 'config_databases') ?>">
            <h4>Base de Datos</h4>
            <p>
							Configura tus instancias de base de datos mediante la definición de su host, su user 
							y su password. Crea tantas como necesites, Butler, hará el resto.
            </p>
            <span>Configurar Base de Datos →</span>
          </a>
        </div>        
        <div class="three columns property">
          <a href="<?php echo Fw_Router::getUrl('config', 'config_configuration') ?>">
            <h4>Variables de Configuración</h4>
            <p>
							Define todo aquello que creas que vas a poder necesitar en tu código mediante la creación de variables de configuración. 
							Puedes separarlas por entornos y lograr así mayor flexibilidad (Producción, Test, Integración...)
            </p>
            <span>Definir Variables de Configuración →</span>
          </a>
        </div>              
        <div class="three columns property">
          <a href="<?php echo Fw_Router::getUrl('config', 'config_routes') ?>">
            <h4>Rutas</h4>
            <p>
							Para gustos, los colores. Define todas y cada una de las rutas de tu aplicación para lograr un posicionamiento web a tu
							medida y a tus necesidades. No es obligatorio. Butler te permitirá acceder a todas las rutas mediante la ruta
							genérica /controller/task pero si que es aconsejable para que nadie conozca la estructura interna de tu aplicación.
            </p>
            <span>Definir rutas →</span>
          </a>
        </div>
      </div>
		</div>
		<div class="row">
			<div class="tablet-padding">
				<div class="three columns property">
					<a href="<?php echo Fw_Router::getUrl('config', 'config_scripts') ?>">
						<h4>Scripts</h4>
						<p>
							Configura tu ACL(Access Control List) para lograr una mayor flexibilidad de uso de tu 
							aplicación o site. Crea roles, recursos y asigna permisos.
						</p>
						<span>Configurar ACL →</span>
					</a>
				</div>
				<div class="three columns property">
					<a href="<?php echo Fw_Router::getUrl('config', 'config_crud') ?>">
						<h4>CRUD</h4>
						<p>
							Configura tus instancias de base de datos mediante la definición de su host, su user 
							y su password. Crea tantas como necesites, Butler, hará el resto.
						</p>
						<span>Configurar Base de Datos →</span>
					</a>
				</div>        
				<div class="three columns property">
					<a href="#" id="databaseDumperButton">
						<h4>Exportar Base de Datos</h4>
						<p>
							Define todo aquello que creas que vas a poder necesitar en tu código mediante la creación de variables de configuración. 
							Puedes separarlas por entornos y lograr así mayor flexibilidad (Producción, Test, Integración...)
						</p>
						<span>Exportar Base de Datos →</span>
					</a>
				</div>              
				<div class="three columns property">
					<a href="<?php echo Fw_Router::getUrl('minify', 'generateAll') ?>">
						<h4>Minificar CSS & JS</h4>
						<p>
							Reduce el peso y el número de peticiones de tus páginas unificando todos tus estilos y scripts en archivos únicos
							y comprimidos. Esto te permitirá cargar más rápido y posicionarte mejor dentro de los buscadores.
						</p>
						<span>Generar archivos minificados →</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="databaseDumper" class="reveal-modal small">
	<h2>Exportación de base de datos</h2>
	<p class="lead">Selecciona el tipo de exportación.</p>
	<p><a href="<?php echo Fw_Router::getUrl('dumper', 'all') ?>">Exportar toda la base de datos</a></p>
	<p><a href="<?php echo Fw_Router::getUrl('dumper', 'schema') ?>">Exportar sólo el schema de base de datos</a></p>
	<a class="close-reveal-modal">&#215;</a>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#databaseDumperButton").click(function() {
			$("#databaseDumper").reveal();
		});
	});
</script>
<style>
	.top-bar{margin-bottom:0;}	
	#admin_menu{padding:0}
</style>
