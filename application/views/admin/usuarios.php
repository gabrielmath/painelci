<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
switch ($tela):
	case 'login':
		echo '<div class="container"><div class="row"><div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">';
		echo form_open("admin/usuarios/login", array('class'=>'custom loginform'));
		echo form_fieldset("Identifique-se");
		erros_validacao();
		get_msg('logoffok');
		get_msg('errologin');
		echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
		echo form_label('Usuário:');
		echo form_input(array('name'=>'txtUsuario', 'class'=>"form-control"), set_value('txtUsuario'), array('autofocus','required'));
		echo '</div></div>';
		echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
		echo form_label('Senha:');
		echo form_input(array('name'=>'txtSenha', 'type' => 'password', 'class'=>"form-control"), set_value('txtSenha'), 'required');
		echo form_hidden('redirect', $this->session->userdata('redir_para'));
		echo '</div></div>';
		echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
		echo form_submit(array('name'=>'logar', 'class'=>'btn btn-primary', 'style' => 'margin-top: 10px; float:right;'), 'Login');
		// echo '</div></div>';
		// echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
		echo '<p>'.anchor('admin/usuarios/nova_senha', 'Esqueci minha senha').'</p>';
		echo '</div></div>';
		echo form_fieldset_close();
		echo form_close();
		echo '</div></div></div>';
		break;
	case 'nova_senha':
		$this->load->view('admin/partials/nova_senha_view');
		break;
	case 'cadastrar':
		$this->load->view('admin/partials/cadastrar_usuario_view');
		break;
	case 'gerenciar':
		$this->load->view('admin/partials/gerenciar_usuario_view');
		break;
	case 'alterar_senha':
		$this->load->view('admin/partials/alterar_senha_view');
		break;
	case 'editar':
		$this->load->view('admin/partials/editar_usuarios_view');
		break;
	default:
		echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>ALERTA!</strong> A tela solicitada não existe.</div>";
		break;
endswitch;

