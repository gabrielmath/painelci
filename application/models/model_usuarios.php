<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_usuarios extends CI_Model
{

	private $tabela = 'tb_usuarios';

	public function do_insert($dados = NULL, $redir = TRUE)
	{
		if ($dados != NULL)
		{
			$this->db->insert($this->tabela, $dados);
			
			if ($this->db->affected_rows() > 0)
			{
				auditoria('Inclusão de usuário', 'Usuário "'.$dados['usu_login'].'" cadastrado no sistema');
				set_msg('msgok',"Cadastro efetuado com sucesso","sucesso");
			}
			else
				set_msg('msgerro',"Erro ao cadastrar os dados","erro");

			if($redir)
				redirect(current_url());
		}	
	}

	public function do_login($usuario = NULL, $senha = NULL)
	{
		if ($usuario && $senha)
		{
			$this->db->where('usu_login', $usuario);
			$this->db->where('usu_senha', $senha);
			$this->db->where('usu_ativo', 1);
			$query = $this->db->get($this->tabela);
			if ($query->num_rows() == 1)
				return TRUE;
			else
			{
				return FALSE;
			}
			
		}
		else
		{
			return FALSE;
		}
	}

	public function do_update($dados = NULL, $condicao = NULL, $redir = TRUE)
	{
		if ($dados != NULL && is_array($condicao))
		{
			$this->db->update($this->tabela, $dados, $condicao);
			if ($this->db->affected_rows() > 0)
			{
				auditoria('Alteração de usuário');
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
				auditoria('Exclusão de usuário');
				set_msg('msgok',"Registro excluído com sucesso","sucesso");
			}
			else
				set_msg('msgerro',"Erro ao excluir registro","erro");
			
			if($redir)
				redirect(current_url());
		}
	}

	public function get_byLogin($login = NULL)
	{
		if ($login != NULL)
		{
			$this->db->where('usu_login', $login);
			$this->db->limit(1);
			return $this->db->get($this->tabela);
		}
		else
		{
			return FALSE;
		}
	}

	public function get_byId($id = NULL)
	{
		if ($id != NULL)
		{
			$this->db->where('usu_id', $id);
			$this->db->limit(1);
			return $this->db->get($this->tabela);
		}
		else
		{
			return FALSE;
		}
	}

	public function get_byEmail($email = NULL)
	{
		if ($email != NULL)
		{
			$this->db->where('usu_email', $email);
			$this->db->limit(1);
			return $this->db->get($this->tabela);
		}
		else
		{
			return FALSE;
		}
	}

	public function get_all()
	{
		return $this->db->get($this->tabela);
	}

}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */