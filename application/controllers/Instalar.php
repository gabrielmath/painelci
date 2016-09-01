<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instalar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		init_painel();
		set_tema('titulo', 'Instalação do Sistema');
		set_tema('conteudo', load_modulo('instalar','instalar',''));
		set_tema('template','instalar_sistema_view');
		load_template();
	}

}

/* End of file Instalar.php */
/* Location: ./application/controllers/Instalar.php */