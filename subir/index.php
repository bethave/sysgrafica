<?php
session_start();
if(isset($_SESSION['id_usu'])){
	header('Location:inicio.php');
}else{
	$mensaje = null;
	if(isset($_SESSION['mensaje'])){
		$mensaje = $_SESSION['mensaje'];
	}
	$_SESSION['mensaje'] = null;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SysGrafica</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="/sysgrafica/iconos/icono_cdt_azul.png" type="image/x-icon">
		<link rel="stylesheet" href="/sysgrafica/estilo/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	  	<link rel="stylesheet" href="/sysgrafica/estilo/dist/css/adminlte.min.css">
		<link rel="stylesheet" href="/sysgrafica/estilo/descarga/font-google.css">
		<link rel="stylesheet" href="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.css">
	  	<link rel="stylesheet" href="/sysgrafica/estilo/plugins/toastr/toastr.min.css">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box card-primary text-center">
			<div class="card-header">
				<h3 class="card-title">SYSGRAFICA</h3>
			</div>
			<div class="card card-info">
				<div class="card-body">
					<p></p>
					<form action="login.php" method="post">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="far fa-user"></i>
								</span>
							</div>
							<input type="text" required="" name="usuario" class="form-control" placeholder="Usuario" autofocus="">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fas fa-key"></i>
								</span>
							</div>
							<input type="password" required="" name="contrasena" class="form-control" placeholder="Contraseña">
						</div>
						<div class="row">
							<button type="submit" class="btn btn-primary btn-block btn-flat">INGRESAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="/sysgrafica/iconos/fontawesome.js"></script>
		<script src="/sysgrafica/estilo/plugins/jquery/jquery.min.js"></script>
		<script src="/sysgrafica/estilo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="/sysgrafica/estilo/plugins/fastclick/fastclick.js"></script>
		<script src="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.js"></script>
		<script src="/sysgrafica/estilo/plugins/toastr/toastr.min.js"></script>
		<script type="text/javascript">
			function mensaje (texto){
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000
				});
				Toast.fire({
	        		type: 'warning',
	        		title: texto
	      		})
			}
			<?php if($mensaje!=null){
				echo 'mensaje("'.$mensaje.'")';
			}?>
		</script>
	</body>
</html>