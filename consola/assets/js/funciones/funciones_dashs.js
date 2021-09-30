var tiempo = 0;+
$(document).ready(function(){
	$(".select").select2();
	show_list();
	var date = $("#fechaoo").val();
	var now = $("#now").val();
	var str = [];
	$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: date,
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			events: "citas.php",
			timeFormat: 'h(:mm)t',
			select: function(start, end){
				$('#ModalAdd #paciente').text("");
				$('#ModalAdd #id_paciente').val("");
				$('#ModalAdd #hora').val("");
				$('#ModalAdd #motivo').val("");
				$('#ModalAdd #color').val("");
				if($("#ModalAdd #doctores").val()>1)
				{
					$('#ModalAdd #doctor').val("");
					$("#ModalAdd #select2-doctor-container").text("Seleccione");
				}
				if($("#ModalAdd #espacios").val()>1)
				{
					$('#ModalAdd #espacio').val("");
					$("#ModalAdd #select2-espacio-container").text("Seleccione");
				}
				$('#ModalAdd #fecha').val(moment(start).format('DD-MM-YYYY'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit1 #id_cita1').val(event.id);
					$('#ModalEdit1 #pacientee1').text(event.title);
					$('#ModalEdit1 #fechae1').val(event.start.format('DD-MM-YYYY'));
					$('#ModalEdit1 #horae1').val(event.start.format('hh:mm A'));
					$('#ModalEdit1').modal('show');
				});
			},
			
	});
	$("#add_fast").click(function(){
		$('#ModalAdd #paciente').text("");
		$('#ModalAdd #id_paciente').val("");
		$('#ModalAdd #hora').val("");
		$('#ModalAdd #motivo').val("");
		$('#ModalAdd #color').val("");
		if($("#ModalAdd #doctores").val()>1)
		{
			$('#ModalAdd #doctor').val("");
			$("#ModalAdd #select2-doctor-container").text("Seleccione");
		}
		if($("#ModalAdd #espacios").val()>1)
		{
			$('#ModalAdd #espacio').val("");
			$("#ModalAdd #select2-espacio-container").text("Seleccione");
		}
		$('#ModalAdd #fecha').val(now);
		$('#ModalAdd').modal('show');
	});
	$("#reloadd").click(function()
	{
		show_list();
	});
	setInterval("show_list();",180000);
	$("#nombre").typeahead(
	{
		//Definimos la ruta y los parametros de la busqueda para el autocomplete
	    source: function(query, process)
	    {
			$.ajax(
			{
	            url: 'autocomplete_paciente.php',
	            type: 'GET',
	            data: 'query=' + query ,
	            dataType: 'JSON',
	            async: true,   
	            //Una vez devueltos los resultados de la busqueda, se pasan los valores al campo del formulario
	            //para ser mostrados 
	            success: function(data)
	            { 	  
	              	process(data);
				}
	        });                
	    },
	    //Se captura el evento del campo de busqueda y se llama a la funcion agregar_factura()
	    updater: function(selection)
	    {
	    	var data0=selection;
			var id = data0.split("|");
			var nombre = id[1];
				id = parseInt(id[0]);
				$("#paciente").text("PACIENTE: "+nombre);
				$("#id_paciente").val(id);

	    }
	});
});
$(function ()
{
	//binding event click for button in modal form
	$(document).on("click", "#btn_add", function(event)
	{
		if($("#id_paciente").val()!="")
		{
			if($("#doctor").val()!="")
			{
				if($("#fecha").val()!="")
				{
					if($("#hora").val()!="")
					{
						if($("#espacio").val()!="")
						{
							if($("#motivo").val()!="")
							{
								agregar_cita(1);
							}
							else
							{
								display_notify("Warning", "Por favor ingrese el motivo de la cita");
							}
						}
						else
						{
							display_notify("Warning", "Por favor seleccione un consultorio");
						}
					}
					else
					{
						display_notify("Warning", "Por favor seleccione una hora");
					}
				}
				else
				{
					display_notify("Warning", "Por favor seleccione una fecha");
				}
			}
			else
			{
				display_notify("Warning", "Por favor seleccione un medico");
			}
		}
		else
		{
			display_notify("Warning", "Por favor seleccione un paciente");
		}
	});
	$(document).on("click", "#btn_edit", function(event)
	{	
		if($("#fechaa").val()!="")
		{
			if($("#horaa").val()!="")
			{
				if($("#estado2").val()!="")
				{
					agregar_cita(0);
				}
				else
				{
					display_notify("Warning", "Por favor seleccione un estado para la cita");
				}
			}
			else
			{
				display_notify("Warning", "Por favor ingrese la hora de la cita");
			}
		}
		else
		{
			display_notify("Warning", "Por favor ingrese la fecha de la cita");
		}
	});
	$(document).on("click", "#btn_edit1", function(event)
	{	
		if($("#fechae1").val()!="")
		{
			if($("#horae1").val()!="")
			{
				editar();
			}
			else
			{
				display_notify("Warning", "Por favor ingrese la hora");
			}
		}
		else
		{
			display_notify("Warning", "Por favor ingrese la fecha");
		}
	});
	// Clean the modal form
	/*$(document).on('hidden.bs.modal', function(e)
	{
		var target = $(e.target);
		target.removeData('bs.modal').find(".modal-content").html('');
	});*/
	
});	
function display_modal(id, paciente, hora, estado)
{
	var fecha = $("#now").val();
	$('#ModalEdit #id_cita').val(id);
	$('#ModalEdit #pacientee').text(paciente);
	//$('#ModalEdit #horae').val(hora);
	//$('#ModalEdit #fechae').val(fecha);
	if(estado==1 || estado==3)
	{
		estado = "";
	}
	$('#ModalEdit #estado2').val(estado);
	if(estado == 4)
	{
		$('#ModalEdit #horae').attr("readonly", true);
		$('#ModalEdit #fechae').attr("readonly", true);
	}
	$('#ModalEdit').modal('show');
}
function autosave(val)
{
	var name=$('#name').val(); 
	if (name==''|| name.length == 0){
		var	typeinfo="Info";
		var msg="The field name is required";
		display_notify(typeinfo,msg);
		$('#name').focus();
	}
	else
	{
		senddata();
	}	
}	
function agregar_cita(i)
{
	if(i)
	{
		var dataString = $("#add_cita").serialize();
	}
	else
	{
		var dataString = $("#edit_cita").serialize();
	}
	$.ajax({
		type:'POST',
		url:"cola.php",
		data: dataString,			
		dataType: 'json',
		success: function(datax)
		{	
			display_notify(datax.typeinfo, datax.msg);
			if(datax.typeinfo == "Success")
			{
				if(i)
				{
					$("#ModalAdd #btn_ca").click();
				}
				else
				{
					$("#ModalEdit #btn_ce").click();
					cambiar_color(datax.id);

				}
				show_list();
				//setInterval("rechargin();",1500);		
			}				
		}
	});      

}
function editar()
{
	
	var dataString = $("#edit_cita1").serialize();
	$.ajax({
		type:'POST',
		url:"cola.php",
		data: dataString,			
		dataType: 'json',
		success: function(datax)
		{	
			display_notify(datax.typeinfo, datax.msg);
			if(datax.typeinfo == "Success")
			{
				$("#ModalEdit1 #btn_ce1").click();
				show_list();
				//setInterval("rechargin();",1500);		
			}				
		}
	});      

}
function rechargin()
{
   reload1();
}
function reload1()
{
	location.href = 'cola.php';	
}
function show_list()
{
	$.ajax({
		type:"POST",
		url:"cola.php",
		data:"process=list",
		dataType:"JSON",
		success: function(datax)
		{
			$("#citados").html(datax.citados);
			$("#espera").html(datax.espera);
			$("#count1").text(datax.num1);
			$("#count2").text(datax.num2);
		},
	});
	$('#calendar').fullCalendar('refetchEvents');
}
$(function(){

    $('body').on('click', '.list-group .list-group-item', function ()
    {
    	uniexis($(this).attr("id"));
        $(this).toggleClass('active');
    });
    $('body').on('dblclick', '.list-group .list-group-item', function ()
    {
    	var str  = $(this).text().split(" - ");
    	var paciente = str[1];
    	var hora = str[0];
    	var id = $(this).attr("id");
    	var estado = $(this).attr("estado");
        display_modal(id, paciente, hora, estado);
    });
    $('.list-arrows button').click(function ()
    {
        var $button = $(this), actives = '';
        if ($button.hasClass('move-left')) {
        	var count1 = parseInt($("#count1").text());
        	var count2 = parseInt($("#count2").text());
        	actives = $('.list-right ul li.active');
        	if(actives.attr("estado") != 4)
        	{
            	actives.removeClass("bg-naranja");
            	actives.addClass("bg-info");
            	actives.attr("estado",'1');
            	dataString = "process=update&id="+actives.attr("id")+"&acc=quit";
            	$.ajax({
            		type:'POST',
            		url:'cola.php',
            		data:dataString,
            		dataType:'json',
            		success: function(datax)
            		{
            			if(datax.typeinfo == "Success")
            			{
            				count1+=1;
            				count2-=1;
            				$("#count1").text(count1);
            				$("#count2").text(count2);
            				actives.clone().appendTo('.list-left ul');
		                    actives.remove();
		                    clear_class();
            			}
            			else 
          				{
          					//display_notify("Error", "Ocurrio un error inesperado, intentelo de nuevo");
          				}
            		},
        		});
            }
            else
            {
            	display_notify("Error", "Este paciente se encuentra en consulta");
            }
       	}
        else if ($button.hasClass('move-right')) {
        	var count1 = parseInt($("#count1").text());
        	var count2 = parseInt($("#count2").text());
        	actives = $('.list-left ul li.active');
        	actives.removeClass("bg-info");
        	actives.addClass("bg-naranja");
        	actives.attr("estado",'3');
        	dataString = "process=update&id="+actives.attr("id")+"&acc=insert";
        	$.ajax({
        		type:'POST',
        		url:'cola.php',
        		data:dataString,
        		dataType:'json',
        		success: function(datax)
        		{
        			if(datax.typeinfo=="Success")
        			{
        				count1-=1;
        				count2+=1;
        				$("#count1").text(count1);
        				$("#count2").text(count2);
        				actives.clone().appendTo('.list-right ul');
			            actives.remove();
			            clear_class();
        			}
        			else
        			{
        				//display_notify("Error", "Ocurrio un error inesperado, intentelo de nuevo");	
        			}
        		},
        	});
        }
        show_list();
    });
    $('.dual-list .selector').click(function ()
    {
        var $checkBox = $(this);
        if (!$checkBox.hasClass('selected')) {
            $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
            $checkBox.children('i').removeClass('fa fa-circle-o').addClass('fa fa-check-circle-o');
        } else {
            $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
            $checkBox.children('i').removeClass('fa fa-check-circle-o').addClass('fa fa-circle-o');
        }
    });
    $('[name="SearchDualList"]').keyup(function (e) 
    {
        var code = e.keyCode || e.which;
        if (code == '9') return;
        if (code == '27') $(this).val(null);
        var $rows = $(this).closest('.dual-list').find('.list-group li');
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        $rows.show().filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
});
function clear_class()
{
	$(".list-group li").each(function(){
		$(this).removeClass("active");
	});
}
function uniexis(id)
{
	$(".list-group li").each(function(){
		if($(this).attr("id") !=id)
		{
			$(this).removeClass("active");
		}
	});
}
function cambiar_color(id)
{
	$(".list-group li").each(function(){
		if($(this).attr("id") == id)
		{
			var text = $(this).text();
			$(this).removeClass("bg-naranja");
			$(this).addClass("bg-green");
			$(this).attr("estado", 4);
			$(this).text(text+" (En consulta)");
		}
	});
}