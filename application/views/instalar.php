<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
switch ($tela):
	case 'instalar':
		$this->load->view('partials/install_system_view');
		break;
	case 'sucesso':
	?>
		<div class="row">
			<div class="col-xs-12">
				<div class='alert alert-danger alert-dismissible textoCentralizado' role='alert'>
					<strong><h2>CONCLUSÃO DA INSTALAÇÃO</h2></strong>
				</div>
			</div>
		</div>
<?php
		echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>ALERTA!</strong> A tela solicitada não existe.</div>";
		break;
endswitch;

