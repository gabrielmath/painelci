<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		init_painel();
		esta_logado();
		$this->load->model('model_paginas');
	}

	public function index()
	{
		$this->gerenciar();
	}

	public function cadastrar()
	{
		$this->form_validation->set_rules('txtTitulo', 'TÍTULO', 'trim|required|ucfirst');
		$this->form_validation->set_rules('txtSlug', 'SLUG', 'trim');
		$this->form_validation->set_rules('txtConteudo', 'CONTEÚDO', 'trim|required|htmlentities');

		if ($this->form_validation->run() == TRUE)
		{
			$dados['pag_titulo'] = $this->input->post('txtTitulo', TRUE);
			$dados['pag_slug'] = $this->input->post('txtSlug', TRUE);
			$dados['pag_conteudo'] = $this->input->post('txtConteudo');

			($dados['pag_slug'] != '') ? $dados['pag_slug'] = slug($dados['pag_slug']) : $dados['pag_slug'] = slug($dados['pag_titulo']);

			$this->model_paginas->do_insert($dados);
			
		}
		set_tema('titulo', 'Cadastrar nova página');
		set_tema('conteudo', load_modulo('paginas','cadastrar'));
		load_template();
	}

	public function editar()
	{
		$this->form_validation->set_rules('txtTitulo', 'TÍTULO', 'trim|required|ucfirst');
		$this->form_validation->set_rules('txtSlug', 'SLUG', 'trim');
		$this->form_validation->set_rules('txtConteudo', 'CONTEÚDO', 'trim|required|htmlentities');

		if ($this->form_validation->run() == TRUE)
		{
			$dados['pag_titulo'] = $this->input->post('txtTitulo', TRUE);
			$dados['pag_slug'] = $this->input->post('txtSlug', TRUE);
			$dados['pag_conteudo'] = $this->input->post('txtConteudo');

			($dados['pag_slug'] != '') ? $dados['pag_slug'] = slug($dados['pag_slug']) : $dados['pag_slug'] = slug($dados['pag_titulo']);

			$this->model_paginas->do_update($dados,array('pag_id' => $this->input->post('txtId', TRUE)));
			
		}
		set_tema('titulo', 'Editar página');
		set_tema('conteudo', load_modulo('paginas','editar'));
		load_template();
	}

	public function gerenciar()
	{
		set_tema('titulo', 'Páginas');
		set_tema('conteudo', load_modulo('paginas','gerenciar'));
		load_template();
	}

	public function excluir()
	{
		if(is_admin(TRUE))
		{
			$id = $this->uri->segment(4);
			if ($id != NULL)
			{
				$query = $this->model_paginas->get_byId($id);
				if ($query->num_rows() == 1)
				{
					$query = $query->row();
					$this->model_paginas->do_delete(array('pag_id'=>$query->pag_id), FALSE);

				}
				else
				{
					set_msg('msgerro','Página não encontrada para exclusão', 'erro');
				}
			}
			else
			{
				set_msg('msgerro','Escolha uma página para excluir', 'erro');
			}	
		}
		redirect('admin/paginas/gerenciar');
	}
}

/* End of file Paginas.php */
/* Location: ./application/controllers/Paginas.php */