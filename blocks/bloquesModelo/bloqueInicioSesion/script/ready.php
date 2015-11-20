
$("#bloqueInicioSesion").validationEngine({
promptPosition : "centerRight",
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});

$("#tablaReporte").dataTable({
	"class": "dataTable display",
	"sPaginationType": "full_numbers",
	
});
$(function() {
            $("botonInicioSesion").button().click(function(event) {
                    alert('hola');
            });
        });

$('#<?php echo $this->campoSeguro('fecha'); ?>').datepicker();

$('#<?php echo $this->campoSeguro('fecha2'); ?>').datepicker({

});

$('#<?php echo $this->campoSeguro('botonInicioSesion')?>').change(
	function(){
		alert('hola');
	}
);



