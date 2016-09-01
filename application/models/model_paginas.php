<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_paginas extends CI_Model
{

	private $tabela = 'tb_paginas';

	public function do_insert($dados = NULL, $redir = FALSE)
	{
		if ($dados != NULL)
		{
			$this->db->insert($this->tabela, $dados);
			
			if ($this->db->affected_rows() > 0)
			{
				auditoria('Inclusão de página', 'Nova página cadastrada no sistema');
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
				auditoria('Alteração de página', "A página com o id ".$condicao['pag_id']." foi alterada");
				set_msg('msgok',"Alteração efetuada com sucesso","sucesso");
			}
			else
				set_msg('msgerro',"Erro ao atualizar os dados","erro");
			
			if($redir)
				redirect(current_url());
		}	
	}

	public function do_delete($condicao = NULL, $redir = TRUE)
	{
		if($condicao != NULL && is_array($condicao))
		{
			$this->db->delete($this->tabela, $condicao);
			if ($this->db->affected_rows() > 0)
			{
				auditoria('Exclusão de páginas', 'A página com o id "'.$condicao['pag_id'].'" foi removida');
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
			$this->db->where('pag_id', $id);
			$this->db->limit(1);
			return $this->db->get($this->tabela);
		}
		else
		{
			return FALSE;
		}
	}
}