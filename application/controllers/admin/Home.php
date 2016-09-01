<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		init_painel();
	}

	public function index()
	{
		$this->inicio();
	}

	public function inicio()
	{
		if (esta_logado(FALSE))
		{
			set_tema('titulo', 'Home');
			set_tema('conteudo', 'Escolha um menu para iniciar');
			load_template();
		}
		else
		{
			// set_msg("errologin",'Acesso restrito, faça login antes de prosseguir', 'erro');
			redirect('admin/usuarios/login');
		}
		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */