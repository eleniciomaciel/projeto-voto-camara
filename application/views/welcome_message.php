<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!doctype html>
<html lang="pt-br">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?= base_url() ?>assets/login/fonts/icomoon/style.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/login/css/owl.carousel.min.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/login/css/bootstrap.min.css">

	<!-- Style -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/login/css/style.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
	<link rel='manifest' href="<?= base_url() ?>manifest.json">
	<script src="<?= base_url() ?>pwabuilder-sw.js"></script>
	<title>C8-tecnology::login</title>
</head>

<body class="img-responsive" style="background-image: url('assets/login/images/back-logo.jpg');">

	<div class="content">
		<div class="container">
			<div class="row justify-content-center">
				<!-- <div class="col-md-6 order-md-2">
          <img src="images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div> -->
				<div class="col-md-6 contents">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="form-block">
								<div class="mb-4 text-center">
								
									<h3>C8 Sistemas <strong>Technology</strong></h3>
									<p class="mb-4">Sistema de voto Eletrônico.</p>
								</div>
								<form id="logForm" autocomplete="off">

									<?php
									$csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
									);
									?>
									<input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />

									<div class="form-group first">
										<label for="username">Login</label>
										<input type="email" class="form-control" name="acesso_login" id="acesso_login">

									</div>
									<div class="form-group last mb-4">
										<label for="password">Senha</label>
										<input type="password" class="form-control" name="acesso_senha" id="acesso_senha">

									</div>

									<!-- <div class="d-flex mb-5 align-items-center">
										<span class="ml-auto">
											<a href="<?= site_url('painel-master') ?>" class="forgot-pass">Esqueci minha senha?</a>
										</span>
									</div> -->

									<button class="btn btn-pill text-white btn-block btn-primary" type="submit">
										<span id="logText"></span>
									</button>


								</form>
								<div id="responseDiv" class="alert text-center" style="margin-top:20px; display:none;">
									<button type="button" class="close btn btn-primary btn-block" id="clearMsg">
										<span aria-hidden="true">&times;</span>
									</button>
									<span id="message"></span>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>


	<script src="<?= base_url() ?>assets/login/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url() ?>assets/login/js/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/login/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/login/js/main.js"></script>

	<script>
		$(document).ready(function() {

			$('#logText').html('<i class="fas fa-sign-out-alt"></i>&nbsp;ENTRAR');
			$('#logForm').submit(function(e) {

				e.preventDefault();
				$('#logText').html('<div class="load"> <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>Verificando....<span class="sr-only">Loading...</span> </div>');
				var user = $('#logForm').serialize();
				var login = function() {
					$.ajax({
						type: 'POST',
						url: "<?= site_url('acesso-restrito-usuarios') ?>",
						dataType: 'json',
						data: user,
						success: function(response) {
							$('#message').html(response.message);
							$('#logText').html('<i class="fas fa-sign-out-alt"></i>&nbsp;ENTRAR');
							if (response.error) {
								$('#responseDiv').removeClass('alert-success').addClass('alert-danger').show();
							} else {
								$('#responseDiv').removeClass('alert-danger').addClass('alert-success').show();
								$('#logForm')[0].reset();
								$('#logForm').hide();
								setTimeout(function() {
									location.reload();
								}, 3000);
							}
						}
					});
				};
				setTimeout(login, 3000);
			});

			$(document).on('click', '#clearMsg', function() {
				$('#responseDiv').hide();
			});

		});
	</script>
</body>

</html>