
function loading(){
	imagen = '<img src="/img/loading.gif" alt="Cargando..." />'
	document.getElementById('imagencargando').innerHTML = imagen;
}

function openModal(idRecurso) {
	var idNombre = idRecurso;
	// document.getElementsByTagName("TR")[1].getAttributeNode("idRecurso");
    document.getElementById("demo").innerHTML = "SELECT * FROM tbl_recurso WHERE idRecurso = "+idRecurso;
}

function Connect() {
	// header('location: index.html');	
	document.getElementById("error").innerHTML = "El usuario o la contraseña son incorrectos";
}
