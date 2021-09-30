$(document).ready(function (){
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
     });
	$('#editable').dataTable({
		"language":{
	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Del _START_ al _END_ de un total de _TOTAL_ registros",
	    "sInfoEmpty":      "Del 0 al 0 de un total de 0 registros",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	        "sFirst":    "Primero",
	        "sLast":     "Último",
	        "sNext":     "Siguiente",
	        "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }
		},
		"pageLength": 25,
	});

	$.fn.datepicker.dates['es'] = {
                days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
                daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
                daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
				};
	window.prettyPrint && prettyPrint();
	$(".datepicker").datepicker({
				format: 'dd-mm-yyyy',
				language:'es',
	});
	$(".timepicker").timepicker({
	    'step': 5,
	    'timeFormat': 'h:i A',
	    'controlType': 'select',
    });
});
$(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange', function (e){ $('body').hasClass('fullscreen-video') ? $('body').removeClass('fullscreen-video') : $('body').addClass('fullscreen-video') });

$(function() {
    var $allVideos = $("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com'], object, embed"),
        $fluidEl = $("figure");

    $allVideos.each(function() {
        $(this)
            // jQuery .data does not work on object/embed elements
            .attr('data-aspectRatio', this.height / this.width)
            .removeAttr('height')
            .removeAttr('width');
    });
    $(window).resize(function() {
        var newWidth = $fluidEl.width();
        $allVideos.each(function() {
            var $el = $(this);
            $el
                .width(newWidth)
                .height(newWidth * $el.attr('data-aspectRatio'));
        });
    }).resize();
});

function display_notify(typeinfo,msg,process){
	// Use toastr for notifications get an parameter from other function
	var infotype=typeinfo;
	var msg=msg;
	toastr.options.positionClass = "toast-top-full-width";
	toastr.options.progressBar = true;
	toastr.options.debug = false;
	toastr.options.showDuration=800;
	toastr.options.hideDuration=1000;
	toastr.options.timeOut = 7000; // 1.5s
	toastr.options.showMethod="fadeIn";
	toastr.options.hideMethod="fadeOut";
	toastr.options.closeButton=true;
	if (infotype=='Success'){
		toastr.success(msg,infotype);
	}
	if (infotype=='Info'){
		toastr.info(msg,infotype);
	}
	if (infotype=='Warning'){
		toastr.warning(msg,infotype);
	}
	if (infotype=='Error'){
		toastr.error(msg,infotype);
	}
}
function cleanvalues(){
	$('#formulario').each (function(){
		this.reset();      
	});
}
