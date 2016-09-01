<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_auditoria extends CI_Model
{

	private $tabela = 'tb_auditoria';

	public function do_insert($dados = NULL, $redir = FALSE)
	{
		if ($dados != NULL)
		{
			$this->db->insert($this->tabela, $dados);
			
			if ($this->db->affected_rows() > 0)
				set_msg('msgok',"Cadastro efetuado com sucesso","sucesso");
			else
				set_msg('msgerro',"Erro ao cadastrar os dados","erro");

			if($redir)
				redirect(current_url());
		}	
	}

	public function get_byId($id = NULL)
	{
		if ($id != NULL)
		{
			$this->db->where('aud_id', $id);
			$this->db->limit(1);
			return $this->db->get($this->tabela);
		}
		else
		{
			return FALSE;
		}
	}

	public function get_all($limit = 0)
	{
		if($limit > 0)
			$this->db->limit($limit);
		
		return $this->db->get($this->tabela);
	}

}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */