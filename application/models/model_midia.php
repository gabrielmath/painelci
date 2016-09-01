<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_midia extends CI_Model
{

	private $tabela = 'tb_midia';

	public function do_insert($dados = NULL, $redir = FALSE)
	{
		if ($dados != NULL)
		{
			$this->db->insert($this->tabela, $dados);
			
			if ($this->db->affected_rows() > 0)
			{
				auditoria('Inclusão de mídia', 'Nova mídia cadastrada no sistema');
				set_msg('msgok',"Cadastro efetuado com sucesso","sucesso");
			}
			else
				set_msg('msgerro',"Erro ao cadastrar os dados","erro");

			if($redir)
				redirect(current_url());
		}	
	}

	public function do_update($dados = NULL, $condicao = NULL, $redir = TRUE)
	{
		if ($dados != NULL && is_array($condicao))
		{
			$this->db->update($this->tabela, $dados, $condicao);
			if ($this->db->affected_rows() > 0)
			{
				auditoria('Alteração de mídia', "A mídia com o id ".$condicao['mid_id']." foi alterada");
				set_msg('msgok',"Alteração efetuada com sucesso","sucesso");
			}
			else
				set_msg('msgerro',"Erro ao atualizar os dados","erro");
			
			if($redir)
				redirect(current_url());
		}	
	}

	public function do_upload($campo)
	{
		if(!is_dir('./uploads/'))
			mkdir('./uploads/');

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload($campo))
		{
			return $this->upload->data();
		}
		else
		{
			return $this->upload->display_errors();
		}		
	}

	public function do_delete($condicao = NULL, $redir = TRUE)
	{
		if($condicao != NULL && is_array($condicao))
		{
			$this->db->delete($this->tabela, $condicao);
			if ($this->db->affected_rows() > 0)
			{
				auditoria('Exclusão de mídia', 'A mídia com o id "'.$condicao['mid_id'].'" foi removida');
				set_msg('msgok',"Registro excluído com sucesso","sucesso");
			}
			else
				set_msg('msgerro',"Erro ao excluir registro","erro");
			
			if($redir)
				redirect(current_url());
		}
	}

	public function get_all()
	{
		return $this->db->get($this->tabela);
	}

	public function get_byId($id = NULL)
	{
		if ($id != NULL)
		{
			$this->db->where('mid_id', $id);
			$this->db->limit(1);
			return $this->db->get($this->tabela);
		}
		else
		{
			return FALSE;
		}
	}
}