<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditoria extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		init_painel();
		esta_logado();
		$this->load->model('model_auditoria');
	}

	public function index()
	{
		$this->gerenciar();
	}

	public function gerenciar()
	{
		
		set_tema('titulo', 'Registros de Auditoria');
		set_tema('conteudo', load_modulo('auditoria','gerenciar'));
		load_template();
	}

}

/* End of file Auditoria.php */
/* Location: ./application/controllers/Auditoria.php */