<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midia extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		init_painel();
		esta_logado();
		$this->load->model('model_midia');
	}
	
	public function index()
	{
		$this->gerenciar();
	}

	public function cadastrar()
	{
		$this->form_validation->set_rules('txtNome', 'NOME', 'trim|required|ucwords');
		$this->form_validation->set_rules('txtDescricao', 'DESCRIÇÃO', 'trim');

		if ($this->form_validation->run() == TRUE)
		{
			$upload = $this->model_midia->do_upload('arquivo');

			if(is_array($upload) && $upload['file_name'] != '')
			{
				$dados['mid_nome'] = $this->input->post('txtNome', TRUE);
				$dados['mid_descricao'] = $this->input->post('txtDescricao', TRUE);
				$dados['mid_arquivo'] = $upload['file_name'];

				$this->model_midia->do_insert($dados);
			}
			else
			{
				set_msg('msgerro', $upload, 'erro');
				redirect(current_url());
			}

			

			
		}
		set_tema('titulo', 'Upload de Imagens');
		set_tema('conteudo', load_modulo('midia','cadastrar'));
		load_template();
	}

	public function editar()
	{
		$this->form_validation->set_rules('txtNome', 'NOME', 'trim|required|ucwords');
		$this->form_validation->set_rules('txtDescricao', 'DESCRIÇÃO', 'trim');
		if ($this->form_validation->run() == TRUE)
		{
			$dados['mid_nome'] = $this->input->post('txtNome', TRUE);
			$dados['mid_descricao'] = $this->input->post('txtDescricao', TRUE);
			$this->model_midia->do_update($dados, array('mid_id'=>$this->input->post('txtId')));
		}
		set_tema('titulo', 'Alterar Mídia');
		set_tema('conteudo', load_modulo('midia','editar'));
		load_template();
	}

	public function gerenciar()
	{
		
		set_tema('titulo', 'Listagem de Mídias');
		set_tema('conteudo', load_modulo('midia','gerenciar'));
		load_template();
	}

	public function excluir()
	{
		if(is_admin(TRUE))
		{
			$id = $this->uri->segment(4);
			if ($id != NULL)
			{
				$query = $this->model_midia->get_byId($id);
				if ($query->num_rows() == 1)
				{
					$query = $query->row();
					unlink('./uploads/'.$query->mid_arquivo);
					$thumbs = glob('./uploads/thumbs/*_'.$query->mid_arquivo);

					foreach($thumbs as $arquivo)
					{
						unlink($arquivo);
					}

					$this->model_midia->do_delete(array('mid_id'=>$query->mid_id), FALSE);

				}
				else
				{
					set_msg('msgerro','Mídia não encontrada para exclusão', 'erro');
				}
			}
			else
			{
				set_msg('msgerro','Escolha uma mídia para excluir', 'erro');
			}	
		}
		redirect('admin/midia/gerenciar');
	}

	public function get_midias()
	{
		// header('Content-Type: application/x-json; charset=utf-8');
		$query = $this->model_midia->get_all();
		$dados = '';
		$i = 0;
		foreach ($query->result() as $key)
		{
			$dados[$i]['title'] = $key->mid_nome;
			// $dados[$i]['value'] = base_url('uploads/'.$key->mid_arquivo);
			$dados[$i]['value'] = $key->mid_arquivo;

			$i++;
		}
		echo json_encode($dados);
	}

	public function get_imgs()
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$this->db->like('mid_nome', $this->input->post('txtPesquisarImg', TRUE));
		if($this->input->post('txtPesquisarImg') == '')
			$this->db->limit(10);

		$this->db->order_by('mid_id', 'DESC');
		$query = $this->model_midia->get_all();

		$retorno = "Nenhum resultado encontrado";
		if($query->num_rows() > 0)
		{
			$retorno = '';
			$query = $query->result();
			foreach ($query as $key)
			{

				$retorno .= '<div class="col-xs-4"><a href="javascript:;" onclick="$(\'.htmleditor\').tinymce().execCommand(\'mceInsertContent\',false,\'<img src='.base_url("uploads/$key->mid_arquivo").' />\');return false;" class="thumbnail" data-dismiss="modal">';
				// $retorno .= '<a href="javascript:;" onclick="$(\'.htmleditor\').tinymce().execCommand(\'mceInsertContent\',false,\'<img src="'.base_url("uploads/$key->mid_arquivo").'" class="thumbnail" />\'); return false;">';
				// $retorno .= "<a href='javascript:;' onclick='$(\".htmleditor\").tinymce().execCommand(\"mceInsertContent\",false,\"<img src='".base_url("uploads/$key->mid_arquivo")."' class='thumbnail' />\"); return false;\">";
				$retorno .= '<img src="'.thumb($key->mid_arquivo, 300, 180, FALSE).'" alt="'.$key->mid_nome.'" data-toggle="tooltip" data-placement="top" title="Clique para inserir" /></a></div>';
			}
		}

		echo json_encode($retorno);
		// $this->output->set_content_type('application/json')->set_output(json_encode());
	}

}

/* End of file Midia.php */
/* Location: ./application/controllers/Midia.php */