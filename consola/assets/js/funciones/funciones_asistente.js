var id_plan = 0;
$(document).ready(function(){
		tour();
});
function tour()
{
	var tour = new Tour({
    debug: true,
    backdrop: false,
    redirect: true,
    basePath: location.pathname.slice(0, location.pathname.lastIndexOf('/')),
    onEnd: function() {
      location.replace("dashboard.php");
      $.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=eliminar_all",
	    	})
    },
    steps: [
    {
	    path: "/dashboard.php",
	    element: "#ayudaaaa",
	    placement: "bottom",
	    title: "Ayuda",
	    content: "Bienvenido al módulo de ayuda, a continuación se le dará un recorrido por las partes que componen su sistema",
    },
    {
	    path: "/dashboard.php",
	    element: ".sidebar-collapse",
	    placement: "right",
	    title: "Menú lateral",
	    content: "Este es el menú lateral en el cual puede encontrar todos los diferentes módulos con el que cuenta su sistema."
    },
    {
	    path: "/dashboard.php",
	    element: ".navbar-static-top",
	    placement: "bottom",
	    title: "Barra superior",
	    content: "Esta es la barra superior donde se encuentra, desde el botón de ocultar el menú lateral hasta el botón de salir."
    },
    {
	    path: "/dashboard.php",
	    element: ".wrapper-content",
	    placement: "left",
	    title: "Escritorio",
	    content: "El escritorio contiene widget para el fácil acceso a los módulos más utilizados, cuenta con gráficos que le muestran las estadísticas de consultas por mes y el historial de citas, también cuenta con un apartado que contiene una lista con todas las citas del día actual."
    },
    {
	    path: "/dashboard.php",
	    element: ".sidebar-collapse",
	    placement: "right",
	    title: "Configuración inicial",
	    content: "Principalmente lo que tiene que hacer es agregar un consultorio para ellos debe dirigirse a Administración del menú lateral de clic en Consultorios."
    },
    {
	    path: "/admin_espacio.php",
	    element: "#btn",
	    placement: "right",
	    title: "Administración de consultorios",
	    content: "Ahora debe de ingresar los detalles del consultorio, de clic en el botón Agregar consultorio"
    },
    {
	    path: "/agregar_espacio.php",
	    element: "#formulario_espacio",
	    placement: "top",
	    title: "Agregar consultorio",
	    content: "Llene los campos",
	    onNext: function() {
	    	$.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=consultorio",
	    	})
	    },
    },
    {
	    path: "/agregar_espacio.php",
	    element: "#submit1",
	    placement: "left",
	    title: "Guardar datos",
	    content: "Luego de haber llenado los campos de clic en el botón Guardar",
	    
    },
    {
	    path: "/admin_espacio.php",
	    element: ".sidebar-collapse",
	    placement: "right",
	    title: "Diagnósticos",
	    content: "Siguiente agregar un diagnostico, para ello diríjase a Administración del menú lateral de clic en Diagnósticos"
    },
    {
	    path: "/admin_diagnostico.php",
	    element: "#btn",
	    placement: "right",
	    title: "Agregar diagnostico",
	    content: "Ahora de clic en el botón Agregar diagnostico"
    },
    {
	    path: "/agregar_diagnostico.php",
	    element: "#formulario_diagnostico",
	    placement: "top",
	    title: "Agregar diagnostico",
	    content: "Llene los campos",
	    onNext: function() {
	    	$.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=diagnostico",
	    	})
	    },
    },
    {
	    path: "/agregar_diagnostico.php",
	    element: "#submit1",
	    placement: "left",
	    title: "Guardar datos",
	    content: "Luego de haber llenado los campos de clic en el botón Guardar",
	    
    },
    {
	    path: "/admin_diagnostico.php",
	    element: ".sidebar-collapse",
	    placement: "right",
	    title: "Exámenes",
	    content: "Siguiente agregar un examen, para ello diríjase a Administración del menú lateral de clic en Exámenes"
    },
    {
	    path: "/admin_examen.php",
	    element: "#btn",
	    placement: "right",
	    title: "Agregar examen",
	    content: "Ahora de clic en el botón Agregar examen"
    },
    {
	    path: "/agregar_examen.php",
	    element: "#formulario_examen",
	    placement: "top",
	    title: "Agregar examen",
	    content: "Llene los campos",
	    onNext: function() {
	    	$.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=examen",
	    	})
	    },
    },
    {
	    path: "/agregar_examen.php",
	    element: "#submit1",
	    placement: "left",
	    title: "Guardar datos",
	    content: "Luego de haber llenado los campos de clic en el botón Guardar",
	    
    },
    {
	    path: "/admin_examen.php",
	    element: ".sidebar-collapse",
	    placement: "right",
	    title: "Servicios",
	    content: "Para finalizar con la configuración inicial debe agregar un servicio, para ello diríjase a Administración del menú lateral de clic en Servicios"
    },
    {
	    path: "/admin_servicio.php",
	    element: "#btn",
	    placement: "right",
	    title: "Agregar servicio",
	    content: "Ahora de clic en el botón Agregar servicio"
    },
    {
	    path: "/agregar_servicio.php",
	    element: "#formulario_servicio",
	    placement: "top",
	    title: "Agregar servicio",
	    content: "Llene los campos",
	    onNext: function() {
	    	$.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=servicio",
	    	})
	    },
    },
    {
	    path: "/agregar_servicio.php",
	    element: "#submit1",
	    placement: "left",
	    title: "Guardar datos",
	    content: "Luego de haber llenado los campos de clic en el botón Guardar",
	    
    },
    {
	    path: "/admin_servicio.php",
	    element: ".medicos",
	    placement: "right",
	    title: "Agregar medico",
	    content: "Para agregar un medico nos dirigimos a la sección Médicos del menú lateral, primero iniciamos agregando una especialidad por lo tanto damos clic en Especialidades"
    },
    {
	    path: "/admin_especialidad.php",
	    element: "#btn",
	    placement: "right",
	    title: "Agregar especialidad",
	    content: "Ahora de clic en el botón Agregar especialidad"
    },
    {
	    path: "/agregar_especialidad.php",
	    element: "#formulario_especialidad",
	    placement: "top",
	    title: "Agregar especialidad",
	    content: "Llene los campos",
	    onNext: function() {
	    	$.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=especialidad",
	    	})
	    },
    },
    {
	    path: "/agregar_especialidad.php",
	    element: "#submit1",
	    placement: "left",
	    title: "Guardar datos",
	    content: "Luego de haber llenado los campos de clic en el botón Guardar",
	    
    },
    {
	    path: "/admin_especialidad.php",
	    element: ".medicos",
	    placement: "right",
	    title: "Agregar medico",
	    content: "Luego de haber agregado la especialidad procedemos a agregar los datos del medico para ello nos dirigimos a la sección Médicos del menú lateral y damos clic en Administrar médicos"
    },
    {
	    path: "/admin_doctor.php",
	    element: "#add_doc",
	    placement: "right",
	    title: "Agregar médico",
	    content: "Ahora damos clic en el botón Agregar médico"
    },
    {
	    path: "/agregar_doctor.php",
	    element: "#formulario_doctor",
	    placement: "top",
	    title: "Agregar médico",
	    content: "Llené todos los campos requeridos (todos los marcados con asterisco).",
	    onNext: function() {
	    	$.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=medico",
	    	})
	    },
    },
    {
	    path: "/agregar_doctor.php",
	    element: "#submit1",
	    placement: "left",
	    title: "Guardar datos",
	    content: "Luego de haber llenado todos los campos procedemos a guardar lo cual lo hacemos dando clic en el boton Guardar.",
	    
    },
    {
	    path: "/admin_doctor.php",
	    element: ".pacientes",
	    placement: "right",
	    title: "Agregar paciente",
	    content: "Luego de haber agregado un medico con su respectiva especialidad ahora pasamos a agregar un paciente para ello nos dirigimos a la sección de Pacientes"
    },
    {
	    path: "/admin_paciente.php",
	    element: "#btn",
	    placement: "right",
	    title: "Agregar paciente",
	    content: "Ahora de clic en el botón Agregar paciente"
    },
    {
	    path: "/agregar_paciente.php",
	    element: "#formulario_paciente",
	    placement: "top",
	    title: "Agregar paciente",
	    content: "Llene los campos los campos, los campos marcados con asterisco (*) son requeridos",
	    onNext: function() {
	    	$.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=paciente",
	    	})
	    },
    },
    {
	    path: "/agregar_paciente.php",
	    element: "#submit1",
	    placement: "left",
	    title: "Guardar datos",
	    content: "Luego de haber llenado los campos de clic en el botón Guardar",
	    
    },
    
    {
	    path: "/admin_paciente.php",
	    element: ".citas",
	    placement: "right",
	    title: "Agregar una cita",
	    content: "Para agregar una cita tiene que acceder al modulo de administración de citas el cual se hace seleccionando Citas del menú lateral, luego de clic en la opción Administrar citas."
    },
    {
	    path: "/admin_cita.php",
	    element: "#btn_citass",
	    placement: "right",
	    title: "Agregar una cita",
	    content: "De clic en el botón Agregar cita"
    },
    {
	    path: "/agregar_cita1.php",
	    element: "#formulario_cita",
	    placement: "top",
	    title: "Agregar una cita",
	    content: "Llené todos los campos requeridos (todos los marcados con asterisco).",
	    onNext: function() {
	    	$.ajax({
	    		url:"datos_tour.php",
	    		type:"POST",
	    		data: "process=cita",
	    	})
	    },
    },
    {
	    path: "/agregar_cita1.php",
	    element: "#submit1",
	    placement: "left",
	    title: "Guardar datos",
	    content: "Luego de haber llenado todos los campos procedemos a guardar lo cual lo hacemos dando clic en el boton Guardar.",
	    
    },
    {
	    path: "/admin_cita.php",
	    element: ".citas",
	    placement: "right",
	    title: "Realizar consulta",
	    content: "Cuando ya ha creado una cita puede realizar una consulta, primero seleccionamos Control de citas que se encuentra en la opción Citas del menú lateral"
    },
    {
	    path: "/cola.php",
	    element: "#paciente_cola",
	    placement: "top",
	    title: "Lista de pacientes en espera",
	    content: "En este apartado se muestran todos los pacientes que están en lista de espera.",
	    onNext: function() {
	    	$.ajax(
	    	{
	    		type:'POST',
	    		url:'datos_tour.php',
	    		data: 'process=id_cola',
	    		dataType:'JSON',
	    		success: function(id)
	    		{
	    			uniexisa(id.id);
	    		}
	    	});
	    },
    },
    {
	    path: "/cola.php",
	    element: "#citados",
	    placement: "top",
	    title: "Pasar un paciente a sala de espera",
	    content: "Para pasar un paciente a la cola de espera damos clic en el nombre del paciente el cual se tomara un color azul",
	    
    },
    {
	    path: "/cola.php",
	    element: ".move-right",
	    placement: "top",
	    title: "Pasar un paciente a sala de espera",
	    content: "Dando clic sobre el botón pasamos el paciente a la lista de pacientes en espera",
	    onNext: function() {
	    	$(".move-right").click();
	    },
    },
    {
	    path: "/cola.php",
	    element: "#paciente_citado",
	    placement: "top",
	    title: "Lista de pacientes en espera",
	    content: 'Luego de cargarlo a la lista de espera se procede a pasar el paciente a consulta, esto se hace dando doble clic en el nombre del paciente se mostrara una ventana donde debe seleccionar la opción "En consulta"',
	    onNext: function() {
	    	$.ajax(
	    	{
	    		type:'POST',
	    		url:'datos_tour.php',
	    		data: 'process=id_cola',
	    		dataType:'JSON',
	    		success: function(id)
	    		{
	    			$.ajax(
			    	{
			    		type:'POST',
			    		url:'cola.php',
			    		data: 'process=edit&id_cita='+id.id+"&estado2=4",
			    		dataType:'JSON',
			    		success: function(id)
			    		{
			    
							cambiar_color(id.id);
			    		}
			    	});
	    		}
	    	});
	    	show_list();
	    },
    },
    {
	    path: "/cola.php",
	    element: "#paciente_citado",
	    title: "Realizar consulta",
	    placement: "top",
	    content: "Cuando el paciente se encuentra en consulta este cambiara a un color verde",
    }, 
    {
	    path: "/consulta.php",
	    element: "#div_consulta",
	    placement: "top",
	    title: "Paciente en consulta",
	    content: "Una ves que el paciente haya sido puesto en consulta el doctor podrá ver todos sus datos en este modulo",
	    onNext: function(){
	    	show_data(0,-999);
			show_list(-999);
	    }
    },
    
    {
	    path: "/consulta.php",
	    element: "#paciente_espera",
	    placement: "top",
	    title: "Lista de pacientes en espera",
	    content: "Aquí se muestran los pacientes que se encuentran en sala de espera que solo podrá ver el doctor que corresponde",
    },
    {
	    path: "/consulta.php",
	    element: "#paciente_consulta",
	    placement: "top",
	    title: "Datos del paciente",
	    content: "En este apartado se cargan todos los datos del paciente que se encuentra en consulta."
    },
    {
	    path: "/consulta.php",
	    element: ".agregar_paciente_btn",
	    placement: "top",
	    title: "Realizar consulta",
	    content: "Si desea realizar una evaluación preliminar de clic en el botón Agregar evaluación."
    },
    {
	    path: "/consulta.php",
	    element: ".realizar_evaluacion_btn",
	    placement: "top",
	    title: "Realizar consulta",
	    content: "Para realizar la consulta de clic en el botón Realizar consulta."
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: ".ibox-content",
	    placement: "top",
	    title: "Paciente en consulta",
	    content: "En este modulo podrá registrar todos los datos referentes a la consulta",
	    onNext: function(){
	    	$("#datos_pac .change").click();

	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#datos_pac",
	    placement: "top",
	    title: "Datos generales del paciente",
	    content: "En este apartado se muestran todos los datos del paciente",
	    onNext: function(){
	    	agregar_singos(-999,'1.72','129','24','120/60', '', '','N/A');
	    	$("#evaluacion_pac .change").click();

	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#evaluacion_pac",
	    placement: "top",
	    title: "Evaluación preliminar del paciente",
	    content: "Datos del estado en el que se encuentra el paciente",
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#eval",
	    placement: "top",
	    title: "Agregar o repetir evaluación",
	    content: "Para agregar o repetir la evaluación de clic en el boton Agregar o Repetir evaluación",
	    onNext: function(){
	    	$("#observacion_pac .change").click();
	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#observacion_pac",
	    placement: "top",
	    title: "Observación del paciente",
	    content: "Agregar o editar el motivo de la consulta",
	    onNext: function(){
	    	if(!exis(-999))
	    	{
	    		agregar_diagnostico(-999, "Diagnostico AbcXyz");
	    	}
	    	$("#diagnostico_pac .change").click();
	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#diagnostico_pac",
	    placement: "top",
	    title: "Diagnóstico del paciente",
	    content: "Agregar un diagnóstico luego de haber realizado la evaluación al paciente",
	    onNext: function(){
	    	$("#otr_diagnostico").val("Otro Diagnostico");
	    	$("#otro_diagnostico .change").click();
	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#otro_diagnostico",
	    placement: "top",
	    title: "Otro diagnóstico",
	    content: "Este campo permite agregar un diagnóstico de forma manual si este no se encuentra en la lista",
	    onNext: function(){
	    	if(!exisa(9089))
	    	{
	    		sendd(9089, "Midazolam 5mg/ 5mL Solucion inyectable HUMAX,","5ml cada 3 dias",1,4);
	    	}
	    	if(!exisa(10))
	    	{
	    		sendd(10, "DOGMATIL 100mg/2mL SOLUCION INYECTABLE (I.M.),","2ml",0,1);
	    	}
	    	if(!exisa(343))
	    	{
	    		sendd(343, "ACETAMINOFEN 120 mg/5 mL TM JARABE,","Una tableta cada 6 horas",0,4);
	    	}
	    	$("#receta_pac .change").click();
	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#receta_pac",
	    placement: "top",
	    title: "Receta del paciente",
	    content: "Lugar donde se muestran los medicamentos que se le recetan al paciente",
	    onNext: function(){
	    	$("#otr_medicamento").val("Otro Medicamento");
	    	$("#otra_receta .change").click();
	    	
	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#otra_receta",
	    placement: "top",
	    title: "Otra receta",
	    content: "Este campo permite recetar un medicamento de forma manual si este no se encuentra en la lista",
	    onNext: function(){
	    	if(!exise(-999))
	    	{
	    		agregar_examen(-999, "Examen AbcXyz");
	    	}
	    	$("#examen_pac .change").click();
	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#examen_pac",
	    placement: "top",
	    title: "Asignación de exámenes",
	    content: "Este apartado permite agregar todos los exámenes que el paciente debe realizarse",
	    onNext: function(){
	    	$("#otr_examen").val("Otro Examen");
	    	$("#otro_examen .change").click();
	    },
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#otro_examen",
	    placement: "top",
	    title: "Otro examen",
	    content: "Este campo permite agregar un examen de forma manual si este no se encuentra en la lista",
    },
    {
	    path: "/consulta1.php?id=-999&acc=new",
	    element: "#finiquit",
	    placement: "left",
	    title: "Finalizar consulta",
	    content: "Luego haber realizado la consulta damos clic en el botón Finalizar consulta",
	    onNext: function(){
	    	$("#finiquit").click();	
	    },
    },
    {
	    path: "/admin_consulta.php",
	    element: ".ibox-content",
	    placement: "top",
	    title: "Consulta realizada",
	    content: "Una ves finalizada la consulta esta se cargara en la lista de consultas de la Administración de consultas",
    },
    {
	    path: "/admin_consulta.php",
	    element: ".vacunas",
	    placement: "right",
	    title: "Vacunas",
	    content: "Si al paciente se le receto un medicamento inyectable puede consultarlo en Vacunas diarias de la sección de Vacunas",
    },
    {
	    path: "/vacuna.php",
	    element: "#inyecc1",
	    placement: "top",
	    title: "Lista de inyecciones pendientes para este día",
	    content: "Muestra una lista de los pacientes que tienen inyecciones pendientes para el día actual",
    },
    {
	    path: "/vacuna.php",
	    element: "#aplicar",
	    placement: "top",
	    title: "Aplicar",
	    content: "Para aplicar una inyección damos clic en el botón Aplicar de la sección de Acción el cual nos mostrara una ventana en la cual debemos confirmar la aplicación de la inyección.",
	    onNext: function()
	    {
	    		aplicar(-999);
	    },
    },
    {
	    path: "/vacuna.php",
	    element: "#plan",
	    placement: "top",
	    title: "Lista de planes de vacunación",
	    content: "Muestra una lista de los pacientes a los cuales se les debe crear un plan de vacunación",
    },
    {
	    path: "/vacuna.php",
	    element: "#crear_plan",
	    placement: "top",
	    title: "Plan de vacunación",
	    content: "Para crear un plan de vacunación damos clic en el botón Crear plan de la sección de Acción el cual nos mostrara el formulario para crear el plan de vacunación",
	    
    },
	{
	    path: "/agregar_plan.php?id_plan=-999",
	    //path: "/vacuna.php",
	    element: ".ibox-content",
	    placement: "top",
	    title: "Plan de vacunación",
	    content: "En este modulo se carga ",
	},
	{
	    path: "/agregar_plan.php?id_plan=-999",
	    element: "#campos_plan",
	    placement: "top",
	    title: "Plan de vacunación",
	    content: "Llenamos los campos de secciones que tendrá el paciente, la dosis que se le aplicara, la fecha que iniciara el plan y la frecuencia de dias",
	    onNext: function(){
	    	$("#sesion").val("3");
	    	$("#dosis").val("2");
	    	$("#frecuencia").val("5");
	    }
	},
	{
	    path: "/agregar_plan.php?id_plan=-999",
	    element: "#btn_generar",
	    placement: "top",
	    title: "Botón continuar",
	    content: "Damos clic en el boton continuar y este nos creara la lista de las citas a las cuales debe asistir el paciente para poder cumplir con su plan de vacunación",
	    onNext: function(){
	    	$("#btn_generar").click();
	    }
	},
	{
	    path: "/agregar_plan.php?id_plan=-999",
	    element: "#boton_agregar",
	    placement: "left",
	    title: "Botón guardar",
	    content: "Por ultimo si estamos de acuerdo con la lista de sesiones que se generan damos clic en el botón Guardar",
	    onNext: function(){
	    	$("#boton_agregar").click();
	    }
	},
	{
	    path: "/admin_vacuna.php",
	    element: ".ibox-content",
	    placement: "top",
	    title: "Administración de planes de vacunación",
	    content: "Aquí podemos ver la lista de todos los planes de vacunación que se encuentran vigentes, podemos ver el progreso del plan y el estado en el que se encuentra",
	},
	{
	    path: "/admin_vacuna.php",
	    element: "#accion_plan",
	    placement: "top",
	    title: "Acciones del plan",
	    content: "En esta sección podrá administrar los planes de vacunación de tal forma que tendrá acceso a ver los detalles o suspender el plan de vacunación, todo esto se hace dando clic en el botón Menú el cual desplegara la lista de acciones. Si seleccionamos la opción Ver detalles se nos mostrara un formulario con todas las citas del plan de vacunación",
	},
	{
	    path: "/admin_detalle_plan.php?id_plan=-999",
	    element: ".ibox-content",
	    placement: "top",
	    title: "Detalles del plan de vacunación",
	    content: "En este modulo se carga los detalles del plan de vacunación como el nombre del paciente el medicamento y la lista de citas a las que toen que asistir",
	},
	{
	    path: "/admin_detalle_plan.php?id_plan=-999",
	    element: "#accion_plan",
	    placement: "top",
	    title: "Aplicar",
	    content: "Desde el modulo de detalles podemos aplicar una o varias de las sesiones, esto se hace dando clic en el botón Menú de la sección de Acción el cual nos desplegara una lista de opciones de las cuales seleccionamos Aplicar, a continuación se nos mostrara una ventana pidiendo confirmar la aplicación",
	    onNext: function()
	    {
	        $(".table tr").each(function(index){
	        	if(index==1)
	        	{
	        		var id = $(this).find("#aplicar_inyecc").attr('href');
	        		var id_det = id.split("=");
	        		var id_detalle = id_det[1].split("&");
	        		var id_d = id_detalle[0];
	        		aplicar(id_d);
	        	}
	        });
	    }
	},
	{
	    path: "/admin_detalle_plan.php?id_plan=-999",
	    element: "#accion_plan",
	    placement: "top",
	    title: "Sesión aplicada",
	    content: "Cuando una de las sesiones se encuentre aplicada el estado cambiara de No a Si y se desactivaran las acciones",
	},
	{
	    path: "/admin_detalle_plan.php?id_plan=-999",
	    element: ".caja",
	    placement: "right",
	    title: "Caja",
	    content: "En este modulo se gestionan todos los cobros por servicio a los pacientes",
	},
	{
	    path: "/cobros.php",
	    element: ".ibox-content",
	    placement: "top",
	    title: "Cobros",
	    content: "En este modulo podemos generar un cobro por un servicio a un paciente",
	},
	{
	    path: "/cobros.php",
	    element: "#forma_pago",
	    placement: "top",
	    title: "Forma de pago",
	    content: "Selecciona el formato de pago y la fecha en que sera efectuado",
	},
	{
	    path: "/cobros.php",
	    element: "#cliente_detalle",
	    placement: "top",
	    title: "Cliente",
	    content: "Selecciona el tipo de cliente",
	},
	{
	    path: "/cobros.php",
	    element: "#detalle_servicio",
	    placement: "top",
	    title: "Detalles del servicio",
	    content: "Selecciona el detalle del servicio",
	},
	{
	    path: "/cobros.php",
	    element: "#btn_fin",
	    placement: "left",
	    title: "Guardar cobro",
	    content: "Luego de haber completado todos los campos procede a guardar lo cual se hace dando clic en el botón Guardar",
		onNext: function(){
			senddata(-999);
		}
	},
	{
	    path: "/admin_caja.php",
	    element: ".ibox-content",
	    placement: "top",
	    title: "Caja",
	    content: "Cuando un cobro es efectuado este se muestra en el Administrador de caja",
	},	
	{
	    path: "/dashboard.php",
	    element: "#ayudaaaa",
	    placement: "bottom",
	    title: "Fin del tour",
	    content: "Final del tour",
	},

    ]
  });

  // init tour
  tour.init();
  
  // start tour
  $('#ayudaaaa').click(function() {
    tour.restart();
  });
}

function uniexisa(id)
{
	$(".list-group li").each(function(){
		if($(this).attr("id") !=id)
		{
			$(this).removeClass("active");
		}
	});
	$(".list-group #"+id+"").addClass('active');
}