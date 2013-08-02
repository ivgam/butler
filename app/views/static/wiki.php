<div id="navbar" class="navbar navbar-static" style="position:fixed;width:100%">
  <div class="navbar-inner">
	<div class="container">
	  <a class="brand" href="<?= BASE_URI ?>">Butler</a>
	  <ul class="nav">
		<li class="dropdown">
		  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			Configuration<b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
			<li><a href="#configuration">Configuration</a></li>
			<li><a href="#configuration-databases">Databases</a></li>
			<li><a href="#configuration-routes">Routes</a></li>
			<li><a href="#configuration-variables">Variables</a></li>
			<li><a href="#configuration-acl">Acl</a></li>
			<li><a href="#configuration-scripts">Scripts</a></li>
		  </ul>
		</li>
		<li class="dropdown">
		  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			Request to Response<b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
			<li><a href="#request-to-response">Request to Response</a></li>
			<li><a href="#rtr-start">Start</a></li>
			<li><a href="#rtr-loading">Loading classes</a></li>
			<li><a href="#rtr-init">Initialize</a></li>
			<li><a href="#rtr-dispatcher">Dispatching</a></li>
			<li><a href="#rtr-router">Routing</a></li>
			<li><a href="#rtr-cache">Caching</a></li>
		  </ul>
		</li>
		<li class="dropdown">
		  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			MVC<b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
			<li><a href="#mvc">MVC</a></li>
			<li><a href="#controllers">Controllers</a></li>
			<li><a href="#layouts">Layouts</a></li>
			<li><a href="#crud">CRUD</a></li>
			<li><a href="#models">Models</a></li>
			<li><a href="#views">Views</a></li>
			<li><a href="#modules">Modules</a></li>
		  </ul>
		</li>
		<li class="dropdown">
		  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			Core Classes<b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
			<li><a href="#core-classes">Core Classes</a></li>
			<li><a href="#fw-register">Fw_Register</a></li>
			<li><a href="#fw-db">Fw_Db</a></li>
		  </ul>
		</li>
		<li class="dropdown">
		  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			Misc<b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
			<li><a href="#misc">Misc</a></li>
			<li><a href="#ccc">CCC</a></li>
			<li><a href="#dumper">Dumper</a></li>
			<li><a href="#i18n">i18n</a></li>
			<li><a href="#debug">Debugging</a></li>
		  </ul>
		</li>
	  </ul>
	</div>
  </div>
</div>
<div class="container" id="content">
  <div class="row">
	<h1 class="page-header">Butler Documentation Wiki</h1>
	<p>
	  Bienvenido a la documentación oficial de Butler. Si encuentras que algo es
	  confuso o que falta por explicar alguna funcionalidad que consideras importante,
	  no dudes en enviar un mail a <a href="mailto:ivan.garcia.maya@gmail.com">ivan.garcia.maya@gmail.com</a>. 
	  Lo intentaremos solucionar lo antes posible. Gracias por tu colaboración y esperamos que
	  esta guía te sirva de ayuda.
	</p>
	<section id="configuration">
	  <h1 class="page-header">Configuration</h1>
	  <h2 id="configuration-databases">Databases <small>/app/databases.ini</small></h2>
	  <p>
		Butler dispone de una configuración multi-instancia que permite
		definir tantas conexiones como nos sean necesarias. Dicha configuración
		se define en el archivo <code class="str">/app/databases.ini</code> , la cual tiene la siguiente
		estructura:
	  </p>
	  <pre>
<span class="kwd">[local]</span>
<span class="var">engine</span> = <span class="str">mysql</span>
<span class="var">host</span> = <span class="str">127.0.0.1</span>
<span class="var">database</span> = <span class="str">butler</span>
<span class="var">port</span> = <span class="str">3306</span>
<span class="var">user</span> = <span class="str">admin</span>
<span class="var">pass</span> = <span class="str">admin</span>
<span class="kwd">[ctc]</span>
<span class="var">engine</span> = <span class="str">sqlsrv</span>
<span class="var">host</span> = <span class="str">127.0.0.1</span>
<span class="var">database</span> = <span class="str">butler-sqlsrv</span>
<span class="var">port</span> = <span class="str">1433</span>
<span class="var">user</span> = <span class="str">admin</span>
<span class="var">pass</span> = <span class="str">admin</span>
	  </pre>
	  <p>
		Cada bloque es una instancia diferente. Por defecto, Butler accederá 
		a la instancia con nombre <code class="str">local</code>. 
		Todas las instancias se crean mediante adaptadores de tipo <code class="str">PDO</code> que se encuentran 
		bajo un patrón singleton. Al ser instancias <code class="str">PDO</code>, no se require de cerrar la conexión, 
		puesto que el mismo objeto, en el método destructor, cierra la conexión.
	  </p>
	  <p>
		Para más información acerca de la creación de instancias y la ejecución
		de querys, haz clic <a href="#fw-db">aquí</a>
	  </p>
	  <h2 id="configuration-routes">Routes</h2>
	  <p>
		Por defecto, Butler trabaja con un enrutador genérico que se basa en 
		poder llamar a cualquier acción de un controlador mediante la 
		norma genérica <code class="str">http://midominio.com/controller/task</code> ,
		donde <code class="str">controller</code> es el resultado de extraer
		el sufijo <code class="str">_controller</code> de nuestro controlador 
		y <code class="str">task</code> es  el nombre del método público que queremos ejecutar.
	  </p>
	  <p>
		No obstante, es posible que queramos crear rutas personalizadas. Par ello,
		Butler incorpora un archivo de rutas situado en <code class="str">/app/config/routes.php</code>, en
		el cual podemos definir tantas rutas como nos sean necesarias. La estructura
		de este fichero es la siguiente:
	  <p>
	  <pre>
<span class="var">$routes</span> = <span class="kwd">array</span>(
<span class="str">"login"</span> => <span class="kwd">array</span>(
	<span class="str">"controller"</span> => <span class="str">"Auth_Controller"</span>,
	<span class="str">"url"</span> => <span class="str">"login"</span>,
	<span class="str">"regex"</span> => <span class="str">"/login/"</span>,
	<span class="str">"params"</span> => <span class="kwd">array</span>(),
	<span class="str">"task"</span> => <span class="str">"login"</span>,
	<span class="str">"resource"</span> => <span class="str">"auth"</span>,
	<span class="str">"cacheable"</span> => <span class="kwd">false</span>
),
<span class="pln">    ...</span>
<span class="pln">    ...</span>
<span class="str">"error"</span> => <span class="kwd">array</span>(
	<span class="str">"controller"</span> => <span class="str">"Error_Controller"</span>,
	<span class="str">"url"</span> => <span class="str">"error"</span>,
	<span class="str">"regex"</span> => <span class="str">"/error/"</span>,
	<span class="str">"params"</span> => <span class="kwd">array</span>(),
	<span class="str">"task"</span> => <span class="str">"error"</span>,
	<span class="str">"resource"</span> => <span class="str">"error"</span>,
	<span class="str">"cacheable"</span> => <span class="kwd">true</span>
)
);</pre>

	  <div class="alert alert-warning">
		Las rutas tienen un efecto de embudo, puesto que se itera sobre ellas
		hasta que una de ellas hace match. Cuanto más arriba en el array
		esté nuestra ruta, más específica debe de ser, puesto que si ponemos
		como primera ruta una ruta con una regex <code class="str">"//"</code>,
		siempre hará match e imposibilitaremos el acceso al resto de rutas.
	  </div>
	  <h2 id="configuration-variables">Variables</h2>
	  <p>
		Butler incorpora un archivo de configuración situado en 
		<code class="str">/app/configuration.ini</code> que permite definir variables
		de entorno a las que tendremos acceso más tarde gracias a la 
		clase <code class="str">Fw_Register</code>. Estas variables se 
		definen por bloques que representan los diferentes entornos (test, prod, integración)
		y siguen una estructura de herencia respecto al bloque <code class="str">config</code>. 
		Si una variable está definida en config, estará en el resto de bloques, aunque podrá ser
		reescrita en cada uno de ellos si lo creemos necesario.
	  </p>
	  <pre>
<span class="kwd">[config]</span>
<span class="var">context</span> = <span class="str">test</span>
<span class="var">database</span> = <span class="str">local</span>
<span class="var">cookie_domain</span> = <span class="str">localhost</span>
<span class="var">from_email</span> = <span class="str">admin@localdomain.com</span>
<span class="var">from_name</span> = <span class="str">Butler</span>
<span class="var">replyto_email</span> = <span class="str">admin@localdomain.com</span>
<span class="var">replyto_name</span> = <span class="str">Butler</span>
<span class="var">mail_host</span> = <span class="str">yeeday.net</span>
<span class="var">mail_port</span> = <span class="str">25</span>
<span class="kwd">[prod]</span>
<span class="pln">    ...</span>
<span class="kwd">[test]</span>
<span class="pln">    ...</span></pre>

	  <h2 id="configuration-acl">Gestión de Acceso (ACL) <small>/app/acl.ini</small></h2>
	  <p>
		La gestión de acceso se configura mediante el archivo 
		<code class="str">/app/acl.ini</code>, en el cual se definen
		los diferentes roles, recursos y subrecursos, y el respectivo
		acceso de cada uno de estos roles a dichos recursos y subrecursos.
	  </p>
	  <p>
		Para aclarar un poco el funcionamiento, listamos a continuación
		la definición de cada uno de estos conceptos:
	  </p>
	  <ul>
		<li><strong>Rol:</strong> Tipo de usuario</li>
		<li><strong>Recurso:</strong> Grupo de controladores</li>
		<li><strong>Subrecurso:</strong> Cada uno de los controladores del aplicativo</li>
	  </ul>
	  <p>Y, a continuación, los pasos a seguir para construir el archivo:</p>
	  <ol>
		<li>
		  Dentro del grupo <code class="str">roles</code>, listamos
		  uno a uno los roles que va a tener el aplicativo y, en el caso
		  de que queramos que un rol herede de otro, igualamos dicho
		  grupo al nombre del grupo padre. En caso contrario, igualamos a 
		  <code class="str">""</code>.
		</li>
		<li>
		  En el grupo <code class="str">resources</code>, listamos
		  los grupos de controladores que utilizaremos más tarde en
		  el grupo subresources. Los igualamos todos a
		  <code class="str">null</code>.
		</li>
		<li>
		  En el grupo <code class="str">subresources</code>, listamos
		  todos los controladores de la aplicación y los igualamos
		  al grupo que queramos de los que hemos creado con anterioridad
		</li>
		<li>
		  Para cada rol, creamos un grupo con nombre igual al grupo,
		  dentro del cual, crearemos las cadenas que determinarán
		  el acceso a las diferentes partes del aplicativo.
		</li>
	  </ol>
	  <div class="alert alert-info">
		Las cadenas que se situan en los grupos de cada uno de los roles,
		tienen la siguiente estructura: 
		<code class="str">role.resourceOrSubresource.task = allow/deny</code>
		<ul>
		  <li>En <code class="str">role</code> ponemos el nombre de unos de los roles.</li>
		  <li>En <code class="str">resourceOrSubresource</code> un recurso o un subrecurso.</li>
		  <li>
			En <code class="str">task</code>, uno de los métodos del subrecurso o 
			<code class="str">all</code>, que determina todos
			los posibles métodos a ejecutar dentro de ese recurso/subrecurso.
		  </li>
		  <li>
			Igualamos a <code class="str">allow</code> si queremos permitir 
			el acceso o a <code class="str">deny</code> si queremos revocar dicho acceso.
		  </li>
		</ul>
	  </div>
	  <pre>
<span class="kwd">[roles]</span>
<span class="var">guest</span>   = <span class="str">""</span>
<span class="var">online</span>  = <span class="str">"guest"</span>
<span class="var">admin</span>   = <span class="str">"online"</span>

<span class="kwd">[resources]</span>
<span class="var">commons</span> = <span class="pln">null</span>
<span class="var">vip</span>     = <span class="pln">null</span>
<span class="var">admin</span>   = <span class="pln">null</span>

<span class="kwd">[subresources]</span>
<span class="var">admin</span>  = <span class="str">"admin"</span>
<span class="var">dumper</span> = <span class="str">"admin"</span>
<span class="var">error</span>  = <span class="str">"commons"</span>
<span class="var">mail</span>   = <span class="str">"vip"</span>
<span class="var">static</span> = <span class="str">"commons"</span>
<span class="var">user</span>   = <span class="str">"admin"</span>

<span class="kwd">[guest]</span>
<span class="var">guest.commons.all</span> = allow

<span class="kwd">[online]</span>
<span class="var">online.vip.all</span> = allow

<span class="kwd">[admin]</span>
<span class="var">admin.admin.all</span> = allow</pre>

	  <h2 id="configuration-scripts">Scripts</h2>
	  <p>
		Butler ofrece la posibilidad de concentrar los scripts (CSS & JS) que serán
		solicitados por nuestras peticiones, haciendo distinción entre los necesarios
		para servir las peticiones del frontend y del backend.
	  </p>
	  <p>
		Para ello, utiliza 4 archivos, 2 para el frontend 
		(<code class="str">/app/config/frontscripts.php</code> y <code class="str">/app/config/frontstyles.php</code>) 
		y 2 para el backend 
		(<code class="str">/app/config/frontscripts.php</code> y <code class="str">/app/config/frontstyles.php</code>) ,
		los cuales listan los archivos que se incluirán en nuestras peticiones. Los CSS se llamarán al final
		del tag <code str="str">&lt;header&gt;</code> y los JS antes del cierre del tag <code str="str">&lt;body&gt;</code>.
	  </p>
	  <p>
		A continuación, mostramos un contenido de ejemplo para cada uno de estos archivos.
	  </p>
	  <h5><small>/app/config/frontscripts.php</small></h5>       
<pre><span class="str">&lt;?php</span>
<span class="var">Fw_CCC</span>::addFrontJs(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/js/bootstrap.min.js'</span>);
<span class="var">Fw_CCC</span>::addFrontJs(<span class="kwd">BASE_URI</span>.<span class="str">'javascripts/validator.js'</span>);
<span class="str">?&gt;</span></pre>

	  <h5><small>/app/config/frontstyles.php</small></h5>
<pre><span class="str">&lt;?php</span>
<span class="var">Fw_CCC</span>::addFrontCSS(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/css/bootstrap.css'</span>);
<span class="var">Fw_CCC</span>::addFrontCSS(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/css/bootstrap-responsive.css'</span>);
<span class="str">?&gt;</span></pre>
	  <h5><small>/app/config/backscripts.php</small></h5>
<pre><span class="str">&lt;?php</span>
<span class="var">Fw_CCC</span>::addBackJs(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/js/bootstrap.min.js'</span>);
<span class="var">Fw_CCC</span>::addBackJs(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/plugins/colorpicker/js/bootstrap-colorpicker.js'</span>);
<span class="var">Fw_CCC</span>::addBackJs(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/plugins/datepicker/js/bootstrap-datepicker.js'</span>);
<span class="var">Fw_CCC</span>::addBackJs(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/plugins/wysihtml5/bootstrap-wysihtml5.js'</span>);
<span class="var">Fw_CCC</span>::addBackJs(<span class="kwd">BASE_URI</span>.<span class="str">'javascripts/validator.js'</span>);
<span class="str">?&gt;</span></pre>
	  <h5><small>/app/config/backstyles.php</small></h5>
<pre><span class="str">&lt;?php</span>
<span class="var">Fw_CCC</span>::addBackCSS(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/css/bootstrap.css'</span>);
<span class="var">Fw_CCC</span>::addBackCSS(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/css/bootstrap-responsive.css'</span>);
<span class="var">Fw_CCC</span>::addBackCSS(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/plugins/colorpicker/css/colorpicker.css'</span>);
<span class="var">Fw_CCC</span>::addBackCSS(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/plugins/datepicker/css/datepicker.css'</span>);
<span class="var">Fw_CCC</span>::addBackCSS(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/plugins/wysihtml5/bootstrap-wysihtml5.css'</span>);
<span class="var">Fw_CCC</span>::addBackCSS(<span class="kwd">BASE_URI</span>.<span class="str">'bootstrap/plugins/fontAwesome/css/font-awesome.min.css'</span>);
<span class="var">Fw_CCC</span>::addBackCSS(<span class="kwd">BASE_URI</span>.<span class="str">'stylesheets/validator.css'</span>);
<span class="str">?&gt;</span></pre>
	</section>
	<section id="request-to-response">
	  <h1 class="page-header">Request to Response<h1>
	  <h2 id="rtr-start">Start <small>/public/index.php</small></h2>
	  <p>
		Todas las peticiones que recibe el servidor son reescritas para que apunten
		al archivo index.php situado en la carpeta public. En el caso de que el virtualhost
		del proyecto apunte a la carpeta raiz de Butler, primero se encuentra con la siguiente
		reescritura, la cual la redirige a la raiz de la carpeta public (que es la más aconsejable
		para tener como carpeta raiz del virtualhost).
	  </p>
	  <h5><small>/.htaccess</small></h5>
	  <pre>
<span class="var">&lt;IfModule</span> <span class="str">mod_rewrite.c</span></span class="var">&gt;</span>
<span class="lit">RewriteEngine On</span>
<span class="lit">RewriteRule</span> ^(.*)$ public/$1 <span class="kwd">[NC,QSA]</span>
<span class="var">&lt;/IfModule&gt;</span></pre>
	  <p>
		Una vez tenemos la petición apuntando a la carpeta pública, obligamos a que ejecute
		el archivo index.php situado en /public/index.php . Esta política solo se tiene en
		cuenta si la ruta que nos están solicitando no es un recurso existente (P.Ej: Un css, un js...).
	  </p>
	  <h5><small>/public/.htaccess</small></h5>
	  <pre>
<span class="var">&lt;IfModule</span> <span class="str">mod_rewrite.c</span></span class="var">&gt;</span>
<span class="lit">RewriteEngine On</span>
<span class="lit">RewriteCond</span> <span class="com">%{REQUEST_FILENAME}</span> -s <span class="kwd">[OR]</span>
<span class="lit">RewriteCond</span> <span class="com">%{REQUEST_FILENAME}</span> -l <span class="kwd">[OR]</span>
<span class="lit">RewriteCond</span> <span class="com">%{REQUEST_FILENAME}</span> -d
<span class="lit">RewriteRule</span> ^.*$ - <span class="kwd">[NC,L]</span>
<span class="lit">RewriteRule</span> ^.*$ index.php <span class="kwd">[NC,L]</span>
<span class="var">&lt;/IfModule&gt;</span></pre>
	  <h2 id="rtr-loading">Loading Classes <small>/app/config/autoloader.php</small></h2>
	  <p>
		La carga de clases automática funciona siguiendo las siguientes normas:
		<table class="table table-condensed table-striped table-bordered">
		  <thead>
			<tr>
			  <th>Type</th>
			  <th>Classname Pattern</th>
			  <th>Filename Pattern</th>
			  <th>Path</th>
			</tr>
			<tr>
			  <td>Controller</td>
			  <td>MyControllerName_Controller</td>
			  <td>mycontrollername.controller.php</td>
			  <td>/app/controllers/</td>
			</tr>
			<tr>
			  <td>Model</td>
			  <td>MyControllerModel_Controller</td>
			  <td>mymodelname.model.php</td>
			  <td>/app/models/</td>
			</tr>
			<tr>
			  <td>Helper</td>
			  <td>MyHelperName_Controller</td>
			  <td>myhelpername.controller.php</td>
			  <td>/app/helpers/</td>
			</tr>
		  </thead>
		</table>
		<div class="alert alert-info">
		  Las clases del core son cargadas automáticamente y se
		  encuentran situadas en <code class="str">/libs/fw</code>
		</div>
		<div class="alert alert-info">
		  Para cargar librerías externas, se debe modificar el archivo 
		  <code class="str">/app/autoloader.php</code> , para que tenga
		  en cuenta la estructura de ficheros de dichas librerías.
		</div>
	  </p>
	  <h2 id="rtr-init">Initialize <small>/app/bootstrap.php</small></h2>
	  <p>
		Tras setear las variables de entorno y definir el autoloader de clases,
		el hilo de ejecución pasa por el archivo <code class="str">/app/bootstrap.php</code>,
		el cual no es más que un concentrador de funciones de inicialización del aplicativo.
		Todas las funciones que contenga este archivo que comiencen por <code class="str">init_</code>,
		serán ejecutadas de orden descendente según su definición en el archivo.
	  </p>
	  <div class="alert alert-info">
		Por defecto, butler incorpora funciones de inicialización de bases de datos,
		de variables globales, del error_handler y del debugger.
	  </div>
	  <h2 id="rtr-dispatcher">Dispatching <small>/libs/fw/class/dispatcher.class.php</small></h2>
	  <p>
		Una vez inicializada la aplicación, tenemos todos los elementos preparados para
		procesar la petición que nos ha sido solicitada. Para ello, Butler instancia
		el Dispatcher, que nos otra cosa que un centro neurálgico desde el cual
		organizar los conceptos de Router, MVC y Caching.
	  </p>

	  <h2 id="rtr-router">Routing <small>/libs/fw/class/router.class.php</small></h2>
	  <p>
		El Dispatcher no es capaz por si solo de conocer cuál es el recurso que nos ha
		sido solicitado. Por ese motivo, hace uso del Router, una pieza que nos sirve
		para centralizar todas las políticas de enrutamiento de nuestra aplicación.
		Por defecto, se utilizará la siguiente:
	  </p>
	  <code class="str">http://midominio.com/controller/task/param1/params2/.../paramN</code><br/><br/>
	  <p>
		Si queremos definir otro tipo de enrutamiento, deberemos extender/modificar la 
		clase Fw_Router o, en el caso de que solo queramos que ciertas URL's sean diferentes,
		crear rutas personalizas en el archivo de rutas (Ver apartado Configuration/Routes).
	  </p>
	  <h2 id="rtr-cache">Caching</h2>
	  <p>
		Por defecto, la caché no está habilitada. Si se quiere habilitar, basta con canviar 
		el valor de la variable de configuración <code class="str">CACHE_MODE</code> a 
		<code class="var">true</code>, situada en el archivo <code class="str">/app/bootstrap.php</code>.
	  </p>
	  <p>
		Una vez habilitada la cache, todas las rutas definidas en el archivo
		<code class="str">/app/config/routes.php</code> que tengan la variable
		<code class="str">cacheable</code> a <code class="var">true</code>, 
		crearán un archivo en la primera petición realizada cada hora sobre
		dicho recurso, archivo que se devolverá al resto de peticiones realizadas
		durante ese período de tiempo.
	  </p>
	  <p>
		Los archivos de cache se generan en la carpeta <code class="str">/app/cache</code>
		y contienen todo el html de la petición a excepción de la barra de debug. El nombre de 
		estos archivos sigue el patrón <code class="str">controller_task_Y_m_d_H_p_urlparams.cache</code>,
		siendo <code class="str">controller</code> el nombre del controlador, <code class="str">task</code>
		el nombre del método, <code class="str">Y_m_d_H</code> el año, mes, día y hora separados por
		<code class="str">_</code> y <code class="str">urlparams</code> el resultado de separar via 
		<code class="str">_</code> aquellos parámetros de la URL que no pertenecen a <code str="str">$_GET</code>.
	  </p>
	  <div class="alert alert-info">
		Los parámetros utilizados en el nombre de los archivos de cache, son aquellos que pertenecen
		a la estructura de la ruta.<br/> 
		<strong>P.Ej:</strong> <code class="str">http://midominio.com/micontroller/mitask/2?p1=v1</code>, 
		generaría el archivo <code class="str">micontroller_mitask_2013_07_05_12_p_2.cache</code>
	  </div>
	</section>
	<section id="mvc">
	  <h1 class="page-header">MVC</h1>
	  <div id="controllers">
		<h2>Controllers</h2>
		<p>
		  Los controladores en Butler no distan mucho del concepto de controlador genérico
		  propio de cualquier patrón Modelo Vista Controlador. No son más que agrupadores
		  de tareas, las cuales se definen mediante métodos públicos. En estos, podemos
		  llamar a los diferentes modelos y vistas, creando el resultado final que precisamos
		  para poder procesar la petición actual.
		</p>
		<p>
		  Los controladores deben extender de <code class="str">Fw_Controller</code> y deben
		  estar situados en la carpeta <code class="str">/app/controllers</code>. Al heredar
		  de esta clase, obtenemos la lógica básica del controlador, que no es otra que una
		  ejecución de tres pasos mediante los métodos <code class="str">pre</code>, 
		  <code class="str">post</code> y <code class="str">execute</code>.
		</p>
		<p>
		  El método <code class="str">pre</code>, si lo extendemos, nos permite efectuar
		  una rutina personalizada antes de ejecutar cualquier tarea de dicho controlador y
		  el método <code class="str">post</code>, ejecutar cualquier tarea una vez la acción
		  ya ha sido ejecutada (que no renderizada).
		</p>
		<div class="alert alert-warning">
		  El resto de métodos de <code class="str">Fw_Controller</code>, aunque son públicos,
		  no conviene extenderlos puesto que definen un comportamiento lógico muy arraigado
		  al core del aplicativo.
		</div>
		<p>
		  Un ejemplo de controlador, podría ser el siguiente:
		</p>
		<h5><small>/libs/fw/controller/auth.controller.php</small></h5>
		<pre>
&lt;?php

class Fw_Auth_Controller extends Fw_Controller {

public function __construct() {
	$this->layout = 'blank';
}

public function login() {
	$this->layout = 'form';
	$user = Fw_Register::getRef('user');
	if (isset($user['usertype'])) {
		switch ($user['usertype']) {
			case 'admin':
				header('Location: ' . BASE_URI . 'admin/');
				exit();
			case 'guest':
			default:
				header('Location: ' . BASE_URI);
				exit();
		}
	}

	$oModel = new User_Model();
	$username = Fw_Filter::getVar('username', 'default', 'post');
	$pwd = Fw_Filter::getVar('pwd', 'default', 'post');
	$oUser = $oModel->userExists($username, md5($pwd));
	if ($oUser) {
		$lifetime = time() + 365 * 24 * 60 * 60;
		$value = implode('&&&&', array('username' => md5($username), 'pwd' => md5($pwd)));
		setcookie('user', $value, $lifetime, '/');
		$url = ($oUser['usertype'] == 'guest') ? BASE_URI : BASE_URI . 'admin/';
		header("Location: $url");
		exit();
	}
	parent::display('login', true);
}

public function logout() {
	$lifetime = time() - 365 * 24 * 60 * 60;
	$value = '';
	setcookie('user', $value, $lifetime, '/');
	header('Location: ' . BASE_URI);
	exit();
}

}

?&gt;</pre>
		<h3 id="layouts">Layouts</h3>
		<p>
		  Los layouts son estructuras de renderización de la página. En otras palabras,
		  cada uno de los diferentes estilos de presentación que nuestro aplicativo
		  puede tener. Por defecto, Butler incorpar tres (blank, admin y default), los
		  cuales se pueden adaptar a nuestras necesidades.
		</p>
		<p>
		  Podemos crear tantos layouts como nos sea necesario y, para usarlos, basta
		  con definir en los controladores (si queremos que afecte a todas las tasks
		  de dicho controlador) o en las task (si queremos que afecte solo a esa tarea).
		</p>
		<p>
		  Una de las cosas que debemos tener en cuenta es la variable <code class="var">$html</code>,
		  la cual no es más que el contenido específico de nuestra tarea (recordemos que un
		  layout ofrece un contenido genérico y nunca un contenido específico).
		</p>
		<p>
		  En lugar donde ubiquemos dicha variable, aparecerá todo el output de la vista.
		</p>
		<h5><small>/app/layouts/blank.php</small></h5>
		<pre>&lt;?php echo $html?&gt;</pre>

		<h3 id="crud">CRUD Controller</h3>
		<p>
		  <code class="str">Fw_CrudController</code> es una clase que extiende de 
		  <code class="str">Fw_Controller</code> y que ofrece la posibilidad
		  de gestionar los registros de una tabla de base de datos de manera
		  sencilla y práctica.
		</p>
		<p>
		  Para llevar a cabo su función, implementa 5 funciones:
		</p>
		<ul>
		  <li>
			<strong>Admin:</strong>
			<p>
			  En formato tabla paginada, muestra todos los registros de la tabla asociada,
			  permitiendo realizar búsquedas personalizadas. Las búsquedas se realizan desde
			  los filtros, pueden ser muti-filtro y dichos filtros siguen la siguiente sintaxis:
			</p>
			<div class="alert alert-info">
			  <ul>
				<li><strong>Búsqueda exacta:</strong> <code class="str">= num</code> o <code class="str">= 'text'</code> </li>
				<li><strong>Búsqueda por intervalo:</strong> <code class="str">> num</code> , <code class="str">< num</code>, <code class="str"><= num</code>, <code class="str">> date</code> ...</li>
				<li><strong>Búsqueda aproximada:</strong> <code class="str">LIKE '%text%'</code> , <code class="str">LIKE 'Text%'</code> ...</li>
			  </ul>
			</div>
			<p>
			  Para configurar esta vista, el controlador que creemos, debe setear de manera correcta el atributo
			  <code class="str">admin_params</code> en el método <code class="str">__construct</code>, el cual es 
			  un array que presenta la siguiente estructura.
			</p>
			<pre>
$this->adminParams = array(
'Title 1' => 'field1',
'Title 2' => 'field2',
...
'Title N' => 'fieldN'
);</pre>
			<div class="alert alert-info">
			  <code class="str">Title N</code> dictamina el título que se mostrará en la tabla de registros
			  y <code class="str">fieldN</code> es el nombre del campo y/o alias de la query que hemos utilizado para obtener
			  el resultado de la tabla.
			</div>
			<h5><small>Vista de admin de User_Controller (<code class="str">/app/controllers/user.controller.php</code>)</small></h5>
			<img src="<?= IMG_URI ?>wiki/crud_admin.png">
		  </li>
		  <li>
			<strong>Edit:</strong>
			<p></p>
			<h5><small>Vista de edit de User_Controller (<code class="str">/app/controllers/user.controller.php</code>)</small></h5>
			<img src="<?= IMG_URI ?>wiki/crud_edit.png">
		  </li>
		  <li>
			<strong>Add:</strong>
			<p></p>
			<h5><small>Vista de add de User_Controller (<code class="str">/app/controllers/user.controller.php</code>)</small></h5>
			<img src="<?= IMG_URI ?>wiki/crud_add.png">
		  </li>
		  <li><strong>Set:</strong></li>
		  <li><strong>Delete:</strong></li>
		</ul>
		<h5><small>/libs/fw/controllers/category.controller.php</small></h5>
		<pre>
&lt;?php

<span class="var">class</span> <strong>Fw_Category_Controller</strong> <span class="kwd">extends</span> Fw_CrudController {

<span class="kwd">public function</span> __construct() {
	<span class="var">$this</span>->model = <span class="str">'Category_Model'</span>;
	<span class="var">$this</span>->setParams = <span class="kwd">array</span>(
		<span class="str">'name'</span> => <span class="kwd">array</span>(<span class="str">'type'</span> => <span class="str">'default'</span>, <span class="str">'container'</span> => <span class="str">'post'</span>),
		<span class="str">'parent'</span> => <span class="kwd">array</span>(<span class="str">'type'</span> => <span class="str">'default'</span>, <span class="str">'container'</span> => <span class="str">'post'</span>)
	);
	<span class="var">$this</span>->adminParams = <span class="kwd">array</span>(
		<span class="str">'ID'</span> => <span class="str">'id'</span>,
		<span class="str">'Name'</span> => <span class="str">'name'</span>,
		<span class="str">'Parent'</span> => <span class="str">'parent'</span>,
		<span class="str">'Created At'</span> => <span class="str">'ts_creation'</span>,
		<span class="str">'Updated At'</span> => <span class="str">'ts_update'</span>,
	);
	<span class="var">$this</span>->editParams = <span class="kwd">array</span>(
		<span class="str">'Name'</span> => <span class="kwd">array</span>(<span class="str">'type'</span> => <span class="str">'text'</span>, <span class="str">'name'</span> => <span class="str">'name'</span>, <span class="str">'populate'</span> => true),
		<span class="str">'Parent'</span> => <span class="kwd">array</span>(<span class="str">'type'</span> => <span class="str">'select'</span>, <span class="str">'name'</span> => <span class="str">'parent'</span>, <span class="str">'table'</span> => <span class="str">'category'</span>, <span class="str">'field'</span> => <span class="str">'name'</span>)
	);
}

}

?&gt;</pre>
	  </div>
	  <div id="models">
		<h2>Models</h2>
		<p>
		  Los modelos, al igual que los controladores, siguen el paradigma tradicional
		  del MVC. En este caso, nos encontramos que todos deben extender de la clase
		  <code class="str">Fw_Model</code>, la cual ya incorpora los métodos básicos
		  de acceso a la información de una tabla.
		</p>
		<p>Estos métodos son:</p>
		<ul>
		  <li>
			<code class="str">delete(<span class="var">$id</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">deleteRow(<span class="var">$id</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">formatSelectCols(<span class="var">$cols</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">getAclDataForSelect(<span class="var">$field</span>, <span class="var">$where</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">getAll(<span class="var">$cols</span>, <span class="var">$fetchmode</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">getData(<span class="var">$count</span>, <span class="var">$limit</span>, <span class="var">$limitstart</span>, <span class="var">$cols</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">getDataForSelect(<span class="var">$table</span>, <span class="var">$field</span>, <span class="var">$join</span>, <span class="var">$where</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">getRow(<span class="var">$id</span>, <span class="var">$cols</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">insert(<span class="var">$values</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">setNMRelationships(<span class="var">$nTable</span>, <span class="var">$mTable</span>, <span class="var">$idNTable</span>, <span class="var">$aIdMTable</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">setRow(<span class="var">$values</span>, <span class="var">$id</span>)</code>
			<p></p>
		  </li>
		  <li>
			<code class="str">update(<span class="var">$id</span>,<span class="var">$values</span>)</code>
			<p></p>
		  </li>
		</ul>
		<h5><small>/libs/fw/models/category.model.php</small></h5>
		<pre>
&lt;?php

class Fw_Category_Model extends Fw_Model {

public function __construct() {
	$this->table = 'category';
	parent::__construct();
}

}

?&gt;</pre>
	  </div>
	  <div id="views">
		<h2>Views</h2>
		<p>

		</p>
	  </div>
	  <div id="modules">
		<h2>Modules</h2>
		<p>

		</p>
	  </div>
	</section>
	<section id="core-classes">
	  <h1 class="page-header">Core Classes</h1>
	  <h2 id="fw-register">Fw_Register</h2>
	  <p>
		Butler incorpora un patrón registro que permite almacenar
		variables/objetos que más tarde nos puede interesar recuperar
		tal y como las guardamos en su momento. Su funcionamiento es
		sencillo.
	  </p>
	  <pre>
//Insertar una variable en el registro
&lt;?php
$var = 2;
Fw_Register::setVar('var',$var);
?&gt;

//Recuperar una variable del registro
&lt;?php
$var = Fw_Register::getVar('var');
?&gt;</pre>

	  <h2 id="fw-db">Fw_Db</h2>
	  <p>
		La clase <code class="str">Fw_Db</code> es una factoria de
		instancias de base de datos que incorpora un patrón
		singleton. Si una instancia ya ha sido solicitada con anterioridad,
		no creará una nueva, si no que devolverá dicha instancia.
	  </p>
	  <p>
		Todas las instancias creadas mediante este sistema,
		heredarán de la implementación estándard de Data Objects
		de PHP (<code class="str">PDO</code>), por lo que
		su uso irá vinculado a las funciones nativas de PHP
		que tiene este tipo de adaptador (
		<a href="http://php.net/manual/es/book.pdo.php">más info</a>).
	  </p>
	  <p>
		Para obtener una instancia y ejecutar una query, deberíamos escribir algo
		parecido al siguiente script:
	  </p>
	  <pre>
<span class="var">$oDb</span> = Fw_Db::getInstance(<span class="str">'local'</span>);
<span class="var">$sSQL</span> = <span class="str">"SELECT * FROM db.table WHERE field = :field"</span>;
<span class="var">$statement</span> = <span class="var">$oDb</span>->prepare(<span class="var">$sSQL</span>);
<span class="var">$statement</span>->bindParam(<span class="str">':field'</span>, <span class="var">$field</span>, <span class="var">PDO</span>::<span class="kwd">PARAM_STR</span>);
<span class="var">$statement</span>->execute();
<span class="var">$aRes</span> = $statement->fetchAll();</pre>
	</section>
	<section id="misc">
	  <h1 class="page-header">Misc</h1>
	  <h2 id="ccc">CCC (Combine Compress and Cache)</h2>
	  <div class="row">
		<img class="span3" src="<?= IMG_URI ?>wiki/ccc.png">
		<div class="span9">
		  <p>
			Butler ofrece la posibilidad de combinar, comprimir y cachear
			todos los js y css en un solo archivo (uno por extensión).
			Para ello, en el panel de administración, basta con hacer 
			clic en la opción minificar scripts, que se sitúa en la
			pestaña de Tools. Esta acción combinará todos los archivos
			que hayamos definido en los archivos de configuración
			de scripts (Véase Configuration/Scripts), agrupándolos
			según pertenezcan al frontend o al backend.
		  </p>
		  <p>
			Por defecto, estos archivos se generan en las carpetas:              
		  </p>
		  <ul>
			<li><code class="str">/public/javascripts/generated/front</code></li>
			<li><code class="str">/public/javascripts/generated/back</code></li>
			<li><code class="str">/public/stylesheets/generated/front</code></li>
			<li><code class="str">/public/stylesheets/generated/back</code></li>
		  </ul>
		  <br/>
		</div>
	  </div>
	  <div class="alert alert-warning">
		Para utilizar el CCC, se deben habilitar la variables de configuración
		<code class="var">MINIFY_JS</code> y <code class="var">MINIFY_CSS</code> , 
		situadas en <code class="str">/app/bootstrap.php</code>
	  </div>
	  <div class="alert alert-warning">
		Los JS y CSS externos y los no situados en los archivos de configuración,
		no estarán presentes en los archivos minificados
	  </div>
	  <div class="alert alert-warning">
		CCC significa Combinar, Comprimir y <strong>Cachear</strong>, por lo que si se realizan
		cambios, no se verán reflejados hasta que no se ejecute nuevamente
		la tarea de <strong>"Minificar Scripts"</strong>.
	  </div>
	  <div class="alert alert-info">
		La ejecución de la acción de minificación de scripts genera un nuevo archivo
		y elimina el anterior.
	  </div>
	  <h2 id="dumper">DB Dumper</h2>
	  <div class="row">
		<img class="span3" src="<?= IMG_URI ?>wiki/db_dump.png">
		<div class="span9">
		  <p>
			Desde el panel de administración tenemos la posibilidad de hacer un dump
			completo o de solo la estructura de la base de datos que por defecto
			utiliza Butler (<code class="str">local</code>). Si se quiere hacer un
			dump de otra de las instancias, habría que modificar el core del aplicativo
			un poco para que permitiera hacer un switch entre las diferentes instancias
			configuradas.
		  </p>
		  <div class="alert alert-warning">
			Debido a que es una funcionalidad no desarrollada por completo, no tiene
			en cuenta que pueda estar habilitado el debug, por lo que cuando este está
			activo, inserta código HTML al final del código SQL resultante. Para evitar
			esta situación, antes de exportar, desactivar el DEBUG_MODE.
		  </div>
		</div>
	  </div>
	  <h2 id="i18n">i18n</h2>
	  <p>
		La internacionalización de textos de Butler se desarrolla mediante la 
		función nativa de PHP <code class="str">getText()</code>, que también
		puede llamarse con el alias reducido <code class="str">_()</code>. Para
		utilizarlo, basta con crear una carpeta para cada uno de los idiomas
		con los diferentes archivos <code class="str">.mo</code> y <code class="str">.po</code>,
		los cuales son cargados de forma automática en el archivo 
		<code class="str">/app/bootstrap.php</code>.
	  </p>
	  <p>
		Para crear los archivos <code class="str">.mo</code> y <code class="str">.po</code>,
		se pueden utilizar diferentes programas y/o librerías. No obstante,
		quizá una de las más fáciles se <a href="http://www.poedit.net/">PoEdit</a>, 
		un software ligero multiplataforma que nos permite parsear todo el repositorio 
		y obtener todos los textos que estamos utilizando de manera automática.
	  </p>
	  <h2 id="debug">Debugging</h2>
	  <p>
		Butler incorpora una Debug Toolbar que nos permitirá trabajar de forma más 
		cómoda en entornos locales, de test e integración. Para habilitarla, basta
		con setear la variable <code class="str">DEBUG_MODE</code> a 
		<code class="var">true</code>. Una vez habilitado, aparecerá en la parte superior
		izquierda de la pantalla un icono como este <i class="icon icon-info-sign"></i>.
		Si hacemos clic en él, se desplegará una toolbar con diferentes secciones, las
		cuales a su vez si hacemos clic, se desplegarán para añadirnos información.
	  </p>
	  <p>Estas secciones son:</p>
	  <ol>
		<li>
		  <strong>Queries</strong>
		  <p>
			En esta sección encontramos todas las queries que se han ejecutado,
			si han se han efectuado correctamente o no, cuanto han tardado, 
			cuantos registros han devuelto/afectado y en que lineas de que
			archivos han sido ejecutadas.
		  </p>
		  <p>
			El número que sale entre paréntesis es el número total de queries
			ejecutadas en la petición actual
		  </p>
		</li>
		<li>
		  <strong>Memory Usage</strong>
		  <p>
			En esta sección se listan todos los archivos por los que ha pasado
			la petición actual y, entre paréntesis, la memoria máxima utilizada
			para procesarla.
		  </p>
		</li>
		<li>
		  <strong>Errors</strong>
		  <p>
			Cuando hacemos pruebas en un entorno de pruebas, a veces es muy
			molesto ver los notices y los warnings pululando por en medio de la
			maquetación de nuestra web. En el modo debug, Butler elimina de la
			maquetación estos textos y los introduce dentro de la barra de debug.
		  </p>
		  <p>
			El número entre paréntesis es el número total de errores que 
			ha detectado el error_handler (
			<code class="str">notices</code>+<code class="str">warnings</code>+
			<code class="str">fatal_errors</code>)
		  </p>
		</li>
		<li>
		  <strong>Headers</strong>
		  <p>
			Contiene todas las cabeceras de nuestra petición. Así podremos
			ver la codificación, si se está comprimiendo o no y información
			varia que nos puede resultar útil.
		</li>
		<li>
		  <strong>Vars</strong>
		  <p>
			En esta sección encontramos todas las variables que llegaron
			con la petición (<code class="str">$_GET</code>, 
			<code class="str">$_POST</code>, <code class="str">$_COOKIE</code>, 
			<code class="str">$_REQUEST</code>, <code class="str">$_SERVER</code>),
			las variables globales y constantes que se definieron para
			procesar la petición actual y las variables que hemos guardado
			en el Registro (vease <code class="str">Fw_Register</code>).
		  </p>
		  <div class="alert alert-info">
			A veces es interesante añadir variables al Fw_Register y comprobar
			su resultado en el debug ya que si hacemos un var_dump, perdemos
			la maquetación y no sabemos exactamente donde aparecerá.
		  </div>
		</li>
		<li>
		  <strong>Time</strong>
		  <p>Tiempo de proceso de la petición</p>
		</li>
	  </ol>
	</section>
  </div>
</div>
<br/><br/><br/><br/><br/>