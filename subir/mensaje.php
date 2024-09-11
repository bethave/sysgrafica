<script type="text/javascript">
	function mensaje (texto, tipo){
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000
  });
  if(tipo == "" || tipo == null){
    tipo = 'warning';
  }
  Toast.fire({
    type: tipo,
    title: texto
  })
}
</script>
<?php if($_SESSION['mensaje'] != ''){ ?>
	<script type="text/javascript">
		mensaje('<?php echo $_SESSION['mensaje']; ?>','<?php echo $_SESSION['tipo_mensaje']; ?>');
	</script>
<?php } ?>