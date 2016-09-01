<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		init_painel();
	}

	public function index()
	{
		$this->gerenciar();
	}

	public function login()
	{
		$this->form_validation->set_rules('txtUsuario','USUÁRIO','trim|required|min_length[4]|strtolower');
		$this->form_validation->set_rules('txtSenha','SENHA','trim|required|min_length[4]|strtolower');
		
		if ($this->form_validation->run() == TRUE or FALSE)
		{
			$usuario = $this->input->post('txtUsuario', TRUE);
			$senha = md5($this->input->post('txtSenha', TRUE));
			$redirect = $this->input->post('redirect', TRUE);
			if ($this->model_usuarios->do_login($usuario,$senha))
			{
				$query = $this->model_usuarios->get_byLogin($usuario)->row();
				$dados = array(
					'user_id' => $query->usu_id,
					'user_nome' => $query->usu_nome,
					'user_admin' => $query->usu_adm,
					'user_logado' => TRUE,
				);

				$this->session->set_userdata($dados);

				auditoria('Login no sistema', 'Login efetuado com sucesso');

				if ($redirect != '')
					redirect($redirect);
				else
					redirect('admin/home');
				
				
			}
			else
			{
				$query = $this->model_usuarios->get_byLogin($usuario)->row();
				if(empty($query))
					set_msg('errologin',"Usuário inexistente",'erro');
				elseif($query->usu_senha != $senha)
					set_msg('errologin',"Senha incorreta",'erro');
				elseif($query->usu_ativo == 0)
					set_msg('errologin',"Usuário inativo",'erro');
				else
					set_msg('errologin',"Erro interno. Contacte o desenvolvedor!",'erro');

				redirect('admin/usuarios/login');
			}
			
		}
		set_tema('titulo', 'Login');
		set_tema('conteudo', load_modulo('usuarios','login'));
		load_template();
	}

	public function logoff()
	{
		auditoria('Logoff no sistema', 'Logoff efetuado com sucesso');
		$this->session->unset_userdata(array('user_id','user_nome','user_admin','user_logado'));
		$this->session->sess_destroy();
		// $this->session->sess_create();
		$this->session->set_flashdata(array('ola'=>'ola'));
		set_msg('logoffok','Logoff efetuado com sucesso', 'sucesso');

		redirect('admin/usuarios/login');
	}

	public function nova_senha()
	{
		$this->form_validation->set_rules('txtEmail','Email','trim|required|valid_email|strtolower');
		
		if ($this->form_validation->run() == TRUE)
		{
			$email = $this->input->post('txtEmail', TRUE);
			$query = $this->model_usuarios->get_byEmail($email);
			if($query->num_rows() == 1)
			{
				$novasenha = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnm0123456789'), 0, 6);
				$mensagem = "<p>Você solicitou uma nova senha para acesso ao painel de administração do site. A partir de agora use a seguinte senha senha para acesso: <strong>$novasenha</p><p> Troque esta senha para uma senha segura e de sua prefência.</p>";

				if($this->sistema->enviar_email($email, 'Nova senha de acesso', $mensagem))
				{
					$dados['usu_senha'] = md5($novasenha);
					$this->model_usuarios->do_update($dados, array('usu_email' => $email), FALSE);

					auditoria('Redefinição de senha', 'O usuário solicitou uma nova senha por e-mail');
					
					set_msg('msgok','Uma nova senha foi enviada para seu email', 'sucesso');
					redirect('admin/usuarios/nova_senha');
				}
				else
				{
					set_msg('msgerro','Erro ao enviar nova senha. Contate o administrador', 'erro');
					redirect('admin/usuarios/nova_senha');
				}
			}
			else
			{
				set_msg('msgerro','Este e-mail não possui cadastro no sistema', 'erro');
					redirect('admin/usuarios/nova_senha');
			}			
		}

		set_tema('titulo', 'Recuperar Senha');
		set_tema('conteudo', load_modulo('usuarios','nova_senha'));
		set_tema('rodape','');
		load_template();
	}

	public function cadastrar()
	{
		esta_logado();
		$this->form_validation->set_message('is_unique','Este {field} já está cadastrado no sistema');
		$this->form_validation->set_message('matches','O campo {field} está diferente do campo {field}');
		$this->form_validation->set_rules('txtNome', 'NOME', 'trim|required|ucwords');
		$this->form_validation->set_rules('txtEmail', 'E-MAIL', 'trim|required|valid_email|is_unique[tb_usuarios.usu_email]|strtolower');
		$this->form_validation->set_rules('txtLogin', 'LOGIN', 'trim|required|min_length[4]|is_unique[tb_usuarios.usu_login]|strtolower');
		$this->form_validation->set_rules('txtSenha', 'SENHA', 'trim|required|min_length[4]|strtolower');
		$this->form_validation->set_rules('txtSenha2', 'REPITA A SENHA', 'trim|required|min_length[4]|strtolower|matches[txtSenha]');
		if ($this->form_validation->run() == TRUE)
		{
			$dados['usu_nome'] = $this->input->post('txtNome', TRUE);
			$dados['usu_email'] = $this->input->post('txtEmail', TRUE);
			$dados['usu_login'] = $this->input->post('txtLogin', TRUE);
			$dados['usu_senha'] = md5($this->input->post('txtSenha', TRUE));

			if(is_admin())
				$dados['usu_adm'] = ($this->input->post('ckbAdm') == 1) ? 1 : 0;

			$this->model_usuarios->do_insert($dados);
		}

		set_tema('titulo', 'Cadastro de Usuários');
		set_tema('conteudo', load_modulo('usuarios','cadastrar'));
		load_template();
	}

	public function gerenciar()
	{
		esta_logado();
		set_tema('titulo', 'Listagem de Usuários');
		set_tema('conteudo', load_modulo('usuarios','gerenciar'));
		load_template();
	}

	public function alterar_senha()
	{
		esta_logado();
		$this->form_validation->set_message('matches','O campo {field} está diferente do campo {field}');
		$this->form_validation->set_rules('txtSenha', 'SENHA', 'trim|required|min_length[4]|strtolower');
		$this->form_validation->set_rules('txtSenha2', 'REPITA A SENHA', 'trim|required|min_length[4]|strtolower|matches[txtSenha]');

		if ($this->form_validation->run() == TRUE)
		{
			$dados['usu_senha'] = md5($this->input->post('txtSenha', TRUE));
			$this->model_usuarios->do_update($dados, array('usu_id'=>$this->input->post('txtId')));

		}
		set_tema('titulo', 'Alterar Senha');
		set_tema('conteudo', load_modulo('usuarios','alterar_senha'));
		load_template();
	}

	public function editar()
	{
		esta_logado();
		$this->form_validation->set_rules('txtNome', 'NOME', 'trim|required|ucwords');
		if ($this->form_validation->run() == TRUE)
		{
			$dados['usu_nome'] = $this->input->post('txtNome', TRUE);
			$dados['usu_ativo'] = ($this->input->post('ckbAtivo') == 1) ? 1 : 0;
			if(is_admin())
				$dados['usu_adm'] = ($this->input->post('ckbAdm') == 1) ? 1 : 0;

			$this->model_usuarios->do_update($dados, array('usu_id'=>$this->input->post('txtId')));
		}
		set_tema('titulo', 'Alterar Usuário');
		set_tema('conteudo', load_modulo('usuarios','editar'));
		load_template();
	}

	public function excluir()
	{
		esta_logado();
		if(is_admin(TRUE))
		{
			$id = $this->uri->segment(4);
			if ($id != NULL)
			{
				$query = $this->model_usuarios->get_byId($id);
				if ($query->num_rows() == 1)
				{
					$query = $query->row();
					if ($query->usu_id != 1)
					{
						$this->model_usuarios->do_delete(array('usu_id'=>$query->usu_id), FALSE);
					}
					else
					{
						set_msg('msgerro','Este usuário não pode ser excluído', 'erro');
					}
				}
				else
				{
					set_msg('msgerro','Usuário não encontrado para exclusão', 'erro');
				}
			}
			else
			{
				set_msg('msgerro','Escolha um usuário para excluir', 'erro');
			}	
		}
		redirect('admin/usuarios/gerenciar');
	}
}

/* End of file Usuarios.php */
/* Location: ./application/controllers/Usuarios.php */