<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		init_painel();
		esta_logado();
		$this->load->model('model_settings');
	}
	
	public function index()
	{
		$this->gerenciar();
	}

	public function gerenciar()
	{
		if(is_admin(TRUE))
		{
			if ($this->input->post('txtNome') && is_admin(TRUE))
			{
				$settings = elements(array('txtNome','txtUrlLogo','txtEmail'), $this->input->post());

				foreach ($settings as $config_nome => $config_valor)
				{
					// Inserir ou atualizar no DB
					set_setting($config_nome, $config_valor);
				}
				set_msg('msgok','Configurações atualizadas com sucesso','sucesso');
				redirect('admin/settings/gerenciar');
			}
		}
		else
			redirect('admin/settings/gerenciar');

		set_tema('titulo', 'Configuração do Sistema');
		set_tema('conteudo', load_modulo('settings','gerenciar'));
		load_template();
	}
}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */