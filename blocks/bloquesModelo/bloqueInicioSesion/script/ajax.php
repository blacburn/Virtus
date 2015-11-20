<?php

?>

<script type="text/javascript">
$('#<?php echo $this->campoSeguro('cedulaPersona')?>').change(function(){
	$('#<?php echo $this->campoSeguro('nombrePersona')?>').val('2015-12-06');
});
</script>