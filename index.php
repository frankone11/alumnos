<!DOCTYPE html>
<html>
	<head>
		<title>Informe de tareas - Kukaltronica</title>
		<meta name="generator" content="Bluefish 2.2.9" />
		<meta name="author" content="Francisco Javier García Olmos" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="estilos/principal.css" rel="stylesheet" type="text/css" />
		<script src="script/datos.js"></script>
	</head>
	<body>
		<div class="cabecera">
			<h1><a href="index.php" class="titulo">Informe de tareas</a></h1>
			<p>Impulsado por Kukaltronica</p>
		</div>
		<div class="cuerpo">
		<h2>Informe de tareas</h2>
<?php
	$error_entrada = 0;
	if(isset($_POST['accion']))
	{
		if($_POST['accion'] == 1)
		{
			if(isset($_POST['correo_profe']) && isset($_POST['boleta']))
			{
				if($_POST['correo_profe'] != "" && $_POST['boleta'] != "")
				{
					if($link = mysqli_connect('localhost', 'kukaltro_webserv', 'DBweb*900'))
					{
			    		mysqli_select_db($link, 'admin_grupos');
			    		$sql = "SELECT P1.id_usuario, P1.nombre, P1.estado, P2.id_alumno, P2.alumno FROM usuarios as P1, alumnos as P2 ".
			    			"WHERE P1.correo = '".$_POST['correo_profe']."' AND P2.boleta = '".$_POST['boleta']."' AND P1.id_usuario = P2.id_usuario ;";
			    			
						//echo "<p>$sql</p>";			    		
			    		
			    		$resultado = mysqli_query($link, $sql);
			    		if($resultado != false)
			    		{
			    			if(mysqli_num_rows($resultado) > 0)
			    			{
			    				$linea = mysqli_fetch_row($resultado);
			    				if($linea[2] != 1)
			    					$error_entrada = 2;
			    				else 
			    				{
									$id_usuario = $linea[0];
									$profe = $linea[1];
									$id_alumno = $linea[3];
									$alumno = $linea[4];
									$error_entrada = 0;
			    					
									echo "<p>Alumno: $alumno</p>\n<p>Boleta: ".$_POST['boleta']."</p>\n<p>Profesor: $profe</p>";
			    				}
			    				mysqli_free_result($resultado);
			    			}
			    			else 
			    				$error_entrada = 1;
			    		}
			    		else 
			    		{
			    			$error_entrada = 3;
			    		}
			    			
		    		}
		    		else
		    			$error_entrada = 4;
					// Cerrar la conexión
					mysqli_close($link);
				}
				else
				{
					$error_entrada = 5;				
				}	
			}
			else 
				$error_entrada = 6;
			
		}
		else
		{
			$error_entrada = 7;
		}
		
		if($error_entrada > 0)
		{
?>
			<p>&nbsp;</p>
			<p>Se ha generado un error al intentar ingresar al sistema.</p>
			<?php
			if($error_entrada == 1)
			{
				echo "<p class=\"muestraerror\">Error, el nombre de usuario o contrase&ntilde;a son incorrectos.</p>";
			}
			elseif($error_entrada == 2)
			{
				echo "<p class=\"muestraerror\">Error, el usuario no tiene acceso al sistema.</p>";
			}
			else if($error_entrada == 7)
			{
				echo "<p class=\"muestraerror\">Error, la acci&oacute;n solicitada no puede ser procesada.</p>";
			}
			elseif($error_entrada == 5 || $error_entrada == 6)
			{
				echo "<p class=\"muestraerror\">Error de entrada: debe de llenar todos los campos.</p>";
			}
			elseif($error_entrada != 0)
			{
				echo "<p class=\"muestraerror\">Error de entrada, posible error en el sistema. Error: ".$error_entrada.".</p>";
			}		
		}
			?>
			<p><a class="submenu" href="index.php" title="Regresar al men&uacute; principal.">Regresar</a></p>
			<?php	
	}
	else
	{
			?>
			<p>Si est&aacute; inscrito, favor ingrese los siguientes datos para ver sus calificaciones.</p>
			<form action="index.php" method="POST">
				<input type="hidden" name="accion" value="1" />
				<p>Correo del profesor: <input type="text" name="correo_profe" required /></p>
				<p>Boleta del alumno: <input type="text" name="boleta" required /></p>
				<p><input type="submit" value="Entrar" class="sesion" /></p>
			</form>
			<p>Si no est&aacute; inscrito, puede preinscribirse a un grupo.</p>
			<p><a class="submenu" href="#" onclick="alert('No disponible por el momento.'); return false;">Preinsribirse a grupo</a></p>
<?php
	}
?>
		</div>
		<div class="pie">
			<p class="centrado">Informe de tareas</p>
			<p class="centrado">Impulsado por Kukaltronica M&eacute;xico 2017</p>
		</div>
	</body>
</html>




