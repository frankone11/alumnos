function CargaInfo(pagina) 
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("pagina").innerHTML = this.responseText;
		}
		else 
		{
			document.getElementById("pagina").innerHTML = "<p><b>Error al obtener la página: "+this.status+"</b></p>";
		}
	};
	xhttp.open("GET", pagina + ".php", true);
	xhttp.send();
	document.getElementById("pagina").innerHTML = "<p><b>Cargando...</b></p>";
}

function CargaPost(pagina, post) 
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("pagina").innerHTML = this.responseText;
		}
		else 
		{
			document.getElementById("pagina").innerHTML = "<p><b>Error al obtener la página: "+this.status+"</b></p>";
		}
	};
	xhttp.open("POST", pagina + ".php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post);
	document.getElementById("pagina").innerHTML = "<p><b>Cargando...</b></p>";
}

function envia_materia()
{
	var enviapost = "ejecutar=3&guardamateria=" + document.getElementById("nombremateria").value;
	CargaPost("materias", enviapost);
}

function modifica_materia()
{
	var enviapost = "ejecutar=4&guardamateria=" + document.getElementById("nombremateria").value
		+ "&id_materia=" + document.getElementById("id_materia").value;
	CargaPost("materias", enviapost);
}

function envia_grupo()
{
	var enviapost = "ejecutar=3&guardagrupo=" + document.getElementById("nombregrupo").value
		+ "&id_materia=" + document.getElementById("id_materia").value;
	CargaPost("grupos", enviapost);
}

function modifica_grupo()
{
	var enviapost = "ejecutar=4&guardagrupo=" + document.getElementById("nombregrupo").value
		+ "&id_grupo=" +document.getElementById("id_grupo").value
		+ "&id_materia=" + document.getElementById("id_materia").value;
	CargaPost("grupos", enviapost);
}

function envia_alumno()
{
	var enviapost = "ejecutar=3&guardaalumno=" + document.getElementById("nombrealumno").value
		+ "&boleta=" + document.getElementById("boleta").value + "&correo=" + document.getElementById("correo").value;
	CargaPost("alumnos", enviapost);
}

function modifica_alumno()
{
	var enviapost = "ejecutar=4&guardaalumno=" + document.getElementById("nombrealumno").value
		+ "&boleta=" +document.getElementById("boleta").value
		+ "&id_alumno=" + document.getElementById("id_alumno").value
		+ "&correo=" + document.getElementById("correo").value;
	CargaPost("alumnos", enviapost);
}

function filtra_alumno()
{
	var enviapost = "ejecutar=6&filtro=" + document.getElementById("filtro").value;
	if(document.getElementById("filtro1").checked == true)		
		enviapost = enviapost + "&tipofiltro=1";
	else
		enviapost = enviapost + "&tipofiltro=0";
		
	CargaPost("alumnos", enviapost);
}

function inscribe_alumno()
{
	var enviapost = "ejecutar=3&id_alumno=" + document.getElementById("id_alumno").value
		+ "&id_grupo=" + document.getElementById("id_grupo").value + "&numlista=" + document.getElementById("numlista").value;
	CargaPost("listas", enviapost);
}

function cambia_numlista()
{
	var enviapost = "ejecutar=5&id_lista_grupo=" + document.getElementById("id_lista_grupo").value
		+ "&numlista=" + document.getElementById("numerolista").value;
	CargaPost("listas", enviapost);
}

function crea_actividad() 
{
	var enviapost = "ejecutar=2&nombre_act=" + document.getElementById("nombre_act").value
		+ "&desc_act=" + document.getElementById("desc_act").value + "&forma_eval=" + document.getElementById("forma_eval").value
		+ "&auto_calificable=" + document.getElementById("auto_calificable").value + "&id_grupo=" + document.getElementById("id_grupo").value
		+ "&fecha_limite=" + document.getElementById("fecha_limite").value;
	CargaPost("actividades", enviapost);
}

function filtra_actividades()
{
	var enviapost = "ejecutar=3&id_grupo=" + document.getElementById("id_grupo").value;
	CargaPost("actividades", enviapost);
}

function entrega_web()
{
	var enviapost = "ejecutar=1&codigo_qr=" + encodeURIComponent(document.getElementById("codigo_qr").value);
	CargaPost("entregas", enviapost);
}
	