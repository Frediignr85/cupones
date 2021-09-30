//Evento donde se llama al modal y se ejecutan 2 funciones para activar datepicker en modal
$(document).on('click','#btnAgregarLote,#editarLote',function(){  
	waiting();	
	showvaluesmodal();
});	

//espera para mostrar datepickers en modal
function waiting(){
	setTimeout(function() {
	for (i = 0; i < 100; i++){text="abc";}; 
		showvaluesmodal(); 
	}, 1000);
}
//mostrar datepicker
function showvaluesmodal(){
	/*
	 *  changeMonth: true,
 changeYear: true,
	 * */
	$('#fecha').datepicker({
				format: "yyyy-mm-dd",
	language: "es",
	autoclose: true,
	 minDate: '+5d',

			}).on(
	'show', function() {
					
	// Obtener valores actuales z-index de cada elemento
		var zIndexModal = $('#viewModal').css('z-index');
		var zIndexFecha = $('.datepicker').css('z-index');
 
        // alert(zIndexModal + zIndexFEcha);
 
        // Re asignamos el valor z-index para mostrar sobre la ventana modal
        $('.datepicker').css('z-index',zIndexModal+1);
	});
	
}
