<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
switch ($tela):
	case 'cadastrar':
			$this->load->view('admin/partials/cadastrar_midia_view');
		break;
	case 'editar':
			$this->load->view('admin/partials/editar_midia_view');
		break;
	case 'gerenciar':
		$this->load->view('admin/partials/gerenciar_midia_view');
		break;
	default:
		echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>ALERTA!</strong> A tela solicitada não existe.</div>";
		break;
endswitch;

