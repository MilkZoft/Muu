<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function translation($text) {
	switch($text) {
		//General:
		case "Yes": return "S�"; break;		
		
		//Website:
		case 'We design <span class="blue bigger">Web</span> to <span class="pink bigger">simplify</span> your <span class="green bigger">life</span>...': return 'Dise�amos <span class="blue bigger2">Web</span> para <span class="pink bigger2">facilitarte</span> la <span class="green bigger2">vida</span>... <br /><br />';
		case "Home": return "Portada"; break;
		case "About us": return "Nosotros"; break;
		case "Projects": return "Proyectos"; break;
		case "Services": return "Servicios"; break;
		case "Portfolio": return "Portafolio"; break;
		case "Contact us": return "Contacto"; break;
		case "Downloads": return "Descargas"; break;
		case "Documentation": return "Documentaci�n"; break;
		case "Forums": return "Foros"; break;
		case "Documentation": return "Documentaci�n"; break;
		case "Technologies": return "Tecnolog�as"; break;
		case "Call us at": return "Llamanos"; break;
		case "Newsletter": return "Suscribete"; break;
		case "Special packages": return "Paquetes especiales"; break;
		case "Alimentation": return "Alimentaci�n"; break;
		case "Courses": return "Cursos"; break;
		case "Lodgings": return "Hospedaje"; break;
		case "Ubication": return "ubicacion"; break;
		case "Facilities": return "Instalaciones"; break;
		//Credits:
		case "All rights reserved": return "Todos los derechos reservados"; break;
		case "Powered by": return "Desarrollado por"; break;
		
		//Applications:
		case "Add": return "Agregar"; break;
		case "Ads": return "Anuncios"; break;
		case "Applications": return "Aplicaciones"; break;
		case "Categories": return "Categor�as"; break;
		case "Configuration": return "Configuraci�n"; break;
		case "Feedback": return "Contacto"; break;
		case "Pages": return "P�ginas"; break;
		case "Users": return "Usuarios"; break;
		case "Gallery": return "Galer�a"; break;
		case "Links": return "Enlaces"; break;
		case "Polls": return "Encuestas"; break;
		case "Support": return "Soporte"; break;
		case "Works": return "Portafolio"; break;
		case "Hotels": return "Hoteles"; break;

		//Others:
		case "Code": return "C�digo"; break;
		case "Situation": return "Situaci�n"; break;
		case "Search": return "B�squeda"; break;
		case "Seek": return "Buscar"; break;
		case "Field": return "Campo"; break;
		case "Order": return "Ordenar"; break;
		case "Ascending": return "Ascendentemente"; break;
		case "Descending": return "Descendentemente"; break;
		case "Results": return "Registros"; break;
		case "Write a album or select": return "Escribe o selecciona un �lbum"; break;
		case "Languages": return "Idiomas"; break;
		case "Answers": return "Respuestas"; break;
		case "Empty answers not be added": return "Las respuestas vac�as no ser�n agregadas"; break;
		case "Type": return "Tipo"; break;
		case "There were no results for this search": return "No se encontraron resultados en esta b�squeda"; break;
		case "Preview": return "Previsualizaci�n"; break;
		case "Enable Comments": return "Habilitar Comentarios"; break;

		//CPanel:
		case "Trash": return "Papelera"; break;
		case "In trash": return "En papelera"; break;
		case "You are in": return "Te encuentras en"; break;
		case "Go back": return "Regresar"; break;
		case "Welcome": return "Bienvenido"; break;
		case "Online users": return "Usuarios en l�nea"; break;
		case "Registered users": return "Usuarios registrados"; break;
		case "Last user": return "�ltimo usuario"; break;
		case "Logout": return "Desconectar"; break;
		case "Last posts": return "�ltimas publicaciones"; break;
		case "Last pages": return "�ltimas p�ginas"; break;
		case "Last links": return "�ltimos enlaces"; break;
		case "Last users": return "�ltimos usuarios"; break;
		case "There are no new pages": return "No hay nuevas p�ginas"; break;
		case "There are no new posts": return "No hay nuevas publicaciones"; break;
		case "There are no new links": return "No hay nuevos enlaces"; break;
		case "There are no new users": return "No hay nuevos usuarios"; break;
		case "Do you want to delete the file?": return "&iquest;Desea eliminar el archivo?"; break;
		case "Do you want to send to the trash the record?": return "&iquest;Desea enviar el registro a la papelera?"; break;
		case "Do you want to edit the record?": return "&iquest;Desea editar el registro?"; break;
		case "Do you want to delete the record permanently?": return "&iquest;Desea eliminar el registro permanentemente?"; break;
		case "Do you want to restore the record?": return "&iquest;Desea restaurar el registro?"; break;
		
		//Results:
		case "Manage Ads": return "Administrar Anuncios"; break;
		case "Manage Applications": return "Administrar Aplicaciones"; break;
		case "Manage Blog": return "Administrar Publicaciones"; break;
		case "Manage Pages": return "Administrar P�ginas"; break;
		
		//Colums:
		case "Application": return "Aplicaci�n"; break;
		case "Title": return "T�tulo"; break;
		case "Username": return "Nombre de usuario"; break;
		case "Question": return "Pregunta"; break;
		case "Name": return "Nombre"; break;
		case "Company": return "Empresa"; break;
		case "Country": return "Pa�s"; break;
		case "District": return "Estado"; break;
		case "Subject": return "Asunto"; break;
		case "Small": return "Peque�a"; break;
		case "Controller": return "Controlador"; break;
		case "Model": return "Modelo"; break;
		case "Adding": return "Agregar"; break;
		case "Author": return "Autor"; break;
		case "Sponsor": return "Patrocinador"; break;
		case "Position": return "Posici�n"; break;
		case "Clicks": return "Clics"; break;
		case "Size": return "Tama�o"; break;
		case "Date": return "Fecha"; break;
		case "Website": return "Sitio Web"; break;
		case "Comments": return "Comentarios"; break;
		case "Subscribed": return "Suscrito"; break;
		case "Album": return "�lbum"; break;
		case "Image": return "Imagen"; break;
		case "Views": return "Vistas"; break;
		case "Language": return "Idioma"; break;
		case "Description": return "Descripci�n"; break;
		case "Follow": return "Seguimiento"; break;
		case "Time": return "Tiempo"; break;
		case "Privilege": return "Privilegio"; break;
		case "BeDefault": return "Por Default"; break;
		case "State": return "Estado"; break;
		case "Active": return "Activo"; break;
		case "Inactive": return "Inactivo"; break;
		case "Deleted": return "Eliminado"; break;
		case "Action": return "Acci�n"; break;
		case "Select": return "Seleccionar"; break;
		case "All": return "Todos"; break;
		case "None": return "Ninguno"; break;
		case "Restore": return "Restaurar"; break;
		case "Delete": return "Eliminar"; break;
		case "Edit": return "Editar"; break;
		case "Send to trash": return "Enviar a la papelera"; break;
		
		//Totals:
		case "post": return "publicaci�n"; break;
		case "posts": return "publicaciones"; break;
		case "image": return "imagen"; break;
		case "images": return "im�genes"; break;
		
		//Add:
		case "Content": return "Contenido"; break;
		case "Tags": return "Etiquetas"; break;
		case "Enable": return "Habilitados"; break;
		case "Disable": return "Deshabilitados"; break;
		case "Published": return "Publicado"; break;
		case "Unpublished": return "Sin Publicar"; break;
		case "Save": return "Guardar"; break;
		case "Cancel": return "Cancelar"; break;
		
		//Categories:
		case "New category": return "Nueva categor�a"; break;
		case "Parent category": return "Categor�a padre"; break;
		case "Add category": return "Agregar categor�a"; break;
		
		//Library:
		case "Images library": return "Librer�a de im�genes"; break;
		case "Documents library": return "Librer�a de documentos"; break;
		case "Make directory": return "Crear directorio"; break;
		case "The new folders will be created and the files will be uploaded in": return "Las nuevas carpetas ser�n creadas y los archivos ser�n subidos en"; break;
		case "Support files": return "Archivos soportados"; break;
		case "Upload": return "Subir"; break;
		case "Go": return "Ir"; break;
		
		//Tags:
		case "Add Tags": return "Agregar Etiquetas"; break;
		case "Separate tags with commas": return "Etiquetas separadas por comas"; break;
		case "Password for this post": return "Contrase�a para esta publicaci�n"; break;
		
		//Pagination:
		case "Previous": return "Anterior"; break;
		case "Next": return "Siguiente"; break;
		
		//Galery:
		case "Select Album": return "Selecciona un �lbum"; break;
		case "Albums": return "�lbums"; break;
		
		//Blog:
		case "Archive": return "Archivo"; break;
		case "in": return "en"; break;
		case "and": return "y"; break;
		case "by": return "por"; break;
		case "before yesterday": return "antier"; break;
		case "yesterday": return "ayer"; break;
		case "more than an hour ago": return "hace m�s de una hora"; break;
		case "now": return "ahora"; break;
		case "Mural image": return "Imagen de mural"; break;
		case "Image for this post": return "Imagen para la publicaci�n"; break;
		case "Read more": return "Leer m�s"; break;
		case "comments": return "comentarios"; break;
		case "comment": return "comentario"; break;
		
		//Feedback
		case "For more information, or simply send your comments, please fill out the form below and we will contact you as soon as possible.": return "Para mayor informaci�n o si gustas enviarnos tus comentarios, porfavor completa el siguiente formulario y te contactaremos a la brevedad posible"; break;
		case "Phone": return "Tel�fono"; break;
		case "Message": return "Mensaje"; break;
		case "Send message": return "Enviar mensaje"; break;
		
		//Forums
		case "Forums": return "Foros"; break;
		case "Forum": return "Foro"; break;
		case "Last Message": return "�ltimo mensaje"; break;
		case "Topics": return "Temas"; break;
		case "Messages": return "Mensajes"; break;
		case "Welcome to the forums of": return "Bienvenido a los foros de"; break;
		case "Options": return "Opciones"; break;
		case "written by": return "escrito por"; break;
		case "Welcome to the forum": return "Bienvenido al foro de"; break;
		case "Feel free of generate new topics": return "Ahora puedes crear nuevos temas"; break;
		case "New topic": return "Nuevo tema"; break;
		case "Topic": return "Tema"; break;
		case "Replies": return "Respuestas"; break;
		case "Visits": return "Visitas"; break;
		case "There are not replies": return "No hay respuestas"; break;
		case "Welcome to this topic": return "Bienvenido a este tema"; break;
		case "Feel free of reply to the topic": return "Sientete libre de responder al tema"; break;
		case "Reply": return "Responder"; break;
		case "reply": return "respuesta"; break;
		case "Login": return "Iniciar Sesi�n"; break;
		case "There are no topics, be the first!": return "�Aqu� no hay temas, s� el primero!"; break;
		case "Sign up": return "Registrarse"; break;
		case "Back": return "Regresar"; break;
		case "Post a topic!": return "�Crea un tema!"; break;
		case "New Topic": return "Nuevo Tema"; break;
		case "Send": return "Enviar"; break;
		case "Moderator": return "Moderador"; break;
		case "Actions": return "Acciones"; break;
		case "Administrator": return "Administrador	"; break;
		case "Super Administrator": return "S�per Administrador	"; break;
		case "New Reply": return "Nueva Respuesta"; break;
		case "Send Reply": return "Enviar Respuesta"; break;
		case "please login to enjoy the forums or register if you don't have an account": return "por favor inicia sesi�n para disfrutar al m�ximo de los foros, o reg�strate si no tienes una cuenta"; break;
		case "Extra information": return "Informaci�n extra"; break;
		case "Last registered users": return "�ltimos usuarios registrados"; break;
		case "Hi there!, you should": return "�Hola!, deberias"; break;
		case "login": return "iniciar sesi�n"; break;
		case "to enjoy full access to the forums": return "para disfrutar acceso completo a los foros"; break;
		case "If you don't have an account, you can create it": return "Si no tienes una cuenta, puedes crearla"; break;
		case "here": return "aqu�"; break;
		case "The reply has been edited correctly": return "La respuesta ha sido editada correctamente"; break;
		case "Do you want to edit the reply?": return "�Quieres editar la respuesta?"; break;
		case "Do you want to delete the reply?": return "�Quieres eliminar la respuesta?"; break;
		case "The reply has been saved correctly": return "La respuesta se ha guardado correctamente"; break;
		case "Do you want to delete the topic?": return "�Quieres eliminar el tema?"; break;
		case "Do you want to edit the topic?": return "�Quieres editar el tema?"; break;
		case "You can <strong>NOT</strong> create new forums": return "T� <strong>NO</strong> puedes crear nuevos foros"; break;
		case "You can <strong>NOT</strong> create new topics": return "T� <strong>NO</strong> puedes crear nuevos temas"; break;
		case "You can <strong>NOT</strong> reply to topics": return "T� <strong>NO</strong> puedes responder a los temas"; break;
		case "You can <strong>NOT</strong> send private messages": return "T� <strong>NO</strong> puedes mandar mensajes privados"; break;
		case "You can": return "T� puedes"; break;
		case "create": return "crear"; break;
		case "There are no topics, be the first! but first": return "�Aqu� no hay temas, s� el primero! Pero antes"; break;
		case "Edit Topic": return "Editar tema"; break;
		case "Edit Reply": return "Editar respuesta"; break;
		case "I edited my topic on": return "Edit&eacute; mi tema en"; break;
		case "I edited my reply on": return "Edit&eacute; mi respuesta en"; break;
		case "Click on the close button below, or out of the box, to enjoy the forums!": return "�Da clic en el bot�n de cerrar, o afuera de la caja, para disfrutar los foros!"; break;
		case "You have been authentified correctly!": return "�Has iniciado sesi�n satisfactoriamente!"; break;
		case "I posted on": return "Yo publiqu&eacute; en"; break;
		case "I replied on": return "Yo respond&iacute;"; break;
		case "new forums": return "nuevos foros"; break;
		case "You can create new topics": return "T� puedes crear nuevos temas"; break;
		case "You can reply to topics": return "T� puedes responder a los temas"; break;
		case "You can send private messages": return "T� puedes mandar mensajes privados"; break;
		case "Hi there!, ": return "�Hola!, "; break;
		case "Here are your statistics": return "Tus estad�sticas"; break;
		case "The reply has been posted correctly": return "La respuesta ha sido publicada correctamente"; break;
		case "to go to the topic and see your reply": return "para ir al tema y ver tu respuesta"; break;
		case "The new topic has been saved correctly": return "El nuevo tema ha sido guardado correctamente"; break;
		case "to go to the forums and see your topic": return "para ir a los foros y ver tu tema"; break;

		
		//Polls
		case "Vote": return "Votar"; break;
		case "You've previously voted on this poll": return "Ya has votado antes en esta encuesta"; break;
		case "Thank you for your vote!": return "�Muchas gracias por tu voto!"; break;
		
		//Configuration:
		case "Name of the Website": return "Nombre del Sitio Web"; break;
		case "URL of the Website": return "URL del Sitio Web"; break;
		case "Slogan of the Website": return "Slogan del Sitio Web"; break;
		case "E-Mail for recieve notifications": return "E-Mail para recibir notificaciones"; break;
		case "Email for send notifications": return "E-Mail para enviar notificaciones"; break;
		case "Default theme": return "Dise�o por defecto"; break;
		case "Default application": return "Applicaci�n por defecto"; break;
		case "Comments validations": return "Validaci�n de comentarios"; break;
		case "Status of the Website": return "Estado del Sitio Web"; break;
		case "Message when the Website is inactive": return "Mensaje cuando el sitio Web este inactivo"; break;
		
		//Months:
		case "January": return "Enero"; break;
		case "February": return "Febrero"; break;
		case "March": return "Marzo"; break;
		case "April": return "Abril"; break;
		case "May": return "Mayo"; break;
		case "June": return "Junio"; break;
		case "July": return "Julio"; break;
		case "August": return "Agosto"; break;
		case "September": return "Septiembre"; break;
		case "October": return "Octubre"; break;
		case "November": return "Noviembre"; break;
		case "December": return "Diciembre"; break;
		
		//Users
		case "Edit Profile": return "Editar Perfil"; break;
		case "User": return "Usuario"; break;
		case "Mail": return "Correo"; break;
		case "Rank": return "Rango"; break;
		case "Gender": return "G�nero"; break;
		case "Birthday": return "Fecha de nacimiento"; break;
		case "Telephone": return "Tel�fono"; break;
		case "Sign": return "Firma"; break;
		case "Town": return "Municipio"; break;
		case "Join Date": return "Registrado desde"; break;
		case "Upload": return "Subir"; break;
		case "Messages": return "Mensajes"; break;
		case "Recieve Messages": return "Mensajes Recibidos"; break;
		case "Member": return "Miembro"; break;
		case "Profile": return "Perfil"; break;
		case "Male": return "Masculino"; break;
		case "Female": return "Femenino"; break;
		case "Main Information": return "Informaci�n Principal"; break;
		case "User Statistics": return "Estad�sticas del Usuario"; break;
		case "User Location": return "Localizaci�n del Usuario"; break;
		case "Social Information": return "Informaci�n Social"; break;
		case "Lost your password?": return "�Perdiste tu contrase�a?"; break;
		case "Password": return "Contrase�a"; break;
		case "Connect": return "Conectarse"; break;
		case "Authentification": return "Autentificaci�n"; break;
		case "Register": return "Registro"; break;
		case "The profile that you are looking for doesn't exists": return "El perfil que est�s buscando no existe"; break;
		case "Your profile has been edited correctly": return "Tu perfil se ha modificado correctamente"; break;
		
	}
	
	return $text;
}
