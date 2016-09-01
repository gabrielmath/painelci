<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Carrega um módulo do sistema devolvendo a tela solicitada
function load_modulo($modulo = NULL, $tela = NULL, $diretorio = "admin")
{
	$CI =& get_instance();

	if ($modulo != NULL)
	{
		return $CI->load->view("$diretorio/$modulo", array('tela' => $tela), TRUE);
	}
	else
	{
		return FALSE;
	}
}

// Seta valores ao array $tema da classe sistema
function set_tema($prop, $valor, $replace = TRUE)
{
	$CI =& get_instance();
	$CI->load->library('sistema');

	if($replace):
		$CI->sistema->tema[$prop] = $valor;
	else:
		if(!isset($CI->sistema->tema[$prop])) $CI->sistema->tema[$prop] = '';
		$CI->sistema->tema[$prop] .= $valor;
	endif;
}

// Retorna os valores do array $tema da classe sistema
function get_tema()
{
	$CI =& get_instance();
	$CI->load->library('sistema');

	return $CI->sistema->tema;
}

// Inicializa o painel adm carregando os recursos necessários
function init_painel()
{
	$CI =& get_instance();
	$CI->load->library(array('sistema','session', 'form_validation'));
	$CI->load->helper(array('form', 'url', 'array', 'text'));
	// Carregamento dos Models
	$CI->load->model(array('model_usuarios'));

	set_tema('titulo_padrao','Painel ADM');
	set_tema('rodape','<p>&copy; 2016 | Todos os direitos reservados</p>');
	set_tema('template', 'painel_view');

	// set_tema('estilos', load_css(array('bootstrap.min','animate','jquery.dataTables.min','dataTables.bootstrap.min','estiloAdm.min')), FALSE);
	set_tema('estilos', load_css(array('bootstrap.min','animate','dataTables.bootstrap.min','estiloAdm.min')), FALSE);
	
	// $scripts = array('jquery-2.1.4.min','bootstrap.min','jquery.mask.min','jquery.dataTables.min','dataTables.bootstrap.min','scriptAdm.min');
	$scripts = array('jquery-2.1.4.min','bootstrap.min','jquery.mask.min','jquery.dataTables.min','dataTables.bootstrap.min');

	$tinymce = array('jquery.tinymce.min');
	$scriptAdm = array('scriptAdm.min');

	set_tema('scripts', load_js($scripts), FALSE);
	set_tema('scripts', load_js($tinymce,'htmleditor'), FALSE);
	set_tema('scripts', load_js($scriptAdm), FALSE);
}

// Carrega um template passando o array $tema como parametro
function load_template()
{
	$CI =& get_instance();
	$CI->load->library('sistema');

	$CI->parser->parse($CI->sistema->tema['template'], get_tema());
}

// Carrega um ou vários arquivos .css de uma pasta
function load_css($arquivo = NULL, $pasta = "dist/css", $media = 'all')
{
	if($arquivo != NULL)
	{
		$CI =& get_instance();
		$CI->load->helper('url');

		$retorno = '';

		if(is_array($arquivo))
		{
			foreach($arquivo as $css)
			{
				$retorno.='<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$css.css").'" media="'.$media.'" />';
			}
		}
		else
		{
			$retorno.='<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$arquivo.css").'" media="'.$media.'" />';
		}
	}
	return $retorno;
}

// Carrega um ou vários arquivos .js de uma pasta ou servidor remoto
function load_js($arquivo = NULL, $pasta = "dist/js", $remoto = FALSE)
{
	if($arquivo != NULL)
	{
		$CI =& get_instance();
		$CI->load->helper('url');

		$retorno = '';

		if(is_array($arquivo))
		{
			foreach($arquivo as $js)
			{
				if($remoto)
				{
					$retorno.='<script type="text/javascript" src="'.$js.'" ></script>';
				}
				else
				{
					$retorno.='<script type="text/javascript" src="'.base_url("$pasta/$js.js").'" ></script>';
				}
			}
		}
		else
		{
			if($remoto)
				{
					$retorno.='<script type="text/javascript" src="'.$arquivo.'" ></script>';
				}
				else
				{
					$retorno.='<script type="text/javascript" src="'.base_url("$pasta/$arquivo.js").'" ></script>';
				}
		}
	}
	return $retorno;
}

// Mostra erros de validação
function erros_validacao()
{
	if(validation_errors())
		echo "<div class='alert alert-danger alert-dismissible' style='margin: 10px 0;' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".validation_errors()."</div>";
}

// Verifica se o usuario está logado no sistema
function esta_logado($redir = TRUE)
{
	$CI =& get_instance();
	$CI->load->library('session');
	$CI->load->helper('url');

	$user_status = $CI->session->userdata('user_logado');
	if(!isset($user_status) || !$user_status)
	{
		if ($redir)
		{
			$CI->session->set_userdata(array('redir_para'=>current_url()));
			set_msg("errologin",'Acesso restrito, faça login antes de prosseguir', 'erro');
			redirect('admin/usuarios/login');
		}
		else
			return FALSE;
	}
	else
	{
		return TRUE;
	}
}

// Define uma mensagem para ser exibida na próxima tela carregada
function set_msg($id = "msgerro", $msg = NULL, $tipo = 'erro')
{
	$CI =& get_instance();
	switch ($tipo) {
		case 'erro':
			$CI->session->set_flashdata($id,"<div class='alert alert-danger alert-dismissible' style='margin: 10px 0;' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$msg."</div>");
			break;
		case 'sucesso':
			$CI->session->set_flashdata($id,"<div class='alert alert-success alert-dismissible' style='margin: 10px 0;' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$msg."</div>");
			break;
		default:
			$CI->session->set_flashdata($id,"<div class='alert alert-info alert-dismissible' style='margin: 10px 0;' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$msg."</div>");
			break;
	}
}

// Verifica se existe uma mensagem para ser exibida na tela atual
function get_msg($id, $printar = TRUE)
{
	$CI =& get_instance();
	if($CI->session->flashdata($id))
	{
		if($printar)
		{
			echo $CI->session->flashdata($id);
			return TRUE;
		}
		else
		{
			return $CI->session->flashdata($id);
		}
	}
	else
	{
		return FALSE;
	}
}

// Verifica se o usuário atual é administrador
function is_admin($set_msg = FALSE)
{
	$CI =& get_instance();

	$user_admin = $CI->session->userdata('user_admin');
	if (!isset($user_admin) || !$user_admin)
	{
		if($set_msg)
			set_msg('msgerro','Seu usuário não tem permissão para executar esta operação','erro');
		return FALSE;
	}
	else
	{
		return TRUE;
	}
	
}

// Gera um breadcrumb com base no controller atual
function breadcrumb()
{
	$CI =& get_instance();
	$CI->load->helper('url');

	$classe = ucfirst($CI->router->class);
	if ($classe == 'Home')
	{
		$classe = '<li>'.anchor('admin/'.$CI->router->class,'Início').'</li>';
	}
	else
	{
		$classe = '<li>'.anchor('admin/'.$CI->router->class, $classe).'</li>';
	}

	$metodo = ucwords(str_replace('_', ' ', $CI->router->method));
	if ($metodo && $metodo != 'Index')
	{
		$metodo = "<li>".anchor('admin/'.$CI->router->class.'/'.$CI->router->method, $metodo).'</li>';
	}
	else
	{
		$metodo = '';
	}

	return 'Sua localização:<ol class="breadcrumb">'.'<li>'.anchor('admin/home', 'Painel').'</li>'.$classe.$metodo.'</ol>';
}

// Seta um registro na tabela de auditoria
function auditoria($operacao, $obs, $query=TRUE)
{
	$CI =& get_instance();
	$CI->load->library('session');
	$CI->load->model('model_auditoria');
	$CI->load->helper('url');

	if ($query)
	{
		$last_query = $CI->db->last_query();
	}
	else
	{
		$last_query = '';
	}

	if(esta_logado(FALSE))
	{
		$user_id = $CI->session->userdata('user_id');
		$user_login = $CI->model_usuarios->get_byId($user_id)->row()->usu_login;
	}
	else
	{
		$user_login = 'Desconhecido';
	}

	$dados = array(
		'aud_usuario' => $user_login,
		'aud_operacao' => $operacao,
		'aud_query' => $last_query,
		'aud_observacao' => $obs,
	);

	$CI->model_auditoria->do_insert($dados);
}

// Gera miniatura d eimagem caso ela ainda não exista
function thumb($imagem = NULL, $largura = 100, $altura = 75, $geraTag = TRUE)
{
	if(!is_dir('./uploads/thumbs/'))
		mkdir('./uploads/thumbs/');

	$CI =& get_instance();
	$CI->load->helper('file');

	$thumb = $largura.'x'.$altura.'_'.$imagem;
	$thumbInfo = get_file_info('./uploads/thumbs/'.$thumb);

	if($thumbInfo != FALSE)
	{
		$retorno = base_url('uploads/thumbs/'.$thumb);
	}
	else
	{
		$CI->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/'.$imagem;
		$config['new_image'] = './uploads/thumbs/'.$thumb;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $largura;
		$config['height'] = $altura;
		$CI->image_lib->initialize($config);

		if($CI->image_lib->resize())
		{
			$CI->image_lib->clear();
			$retorno = base_url('uploads/thumbs/'.$thumb);
		}
		else
		{
			$retorno = FALSE;
		}
	}
	if($geraTag && $retorno != FALSE)
		$retorno = '<img src="'.$retorno.'" alt="">';

	return $retorno;
}

// Gera um slug baseado no título
function slug($string = NULL)
{
	$string = remove_acentos($string); //remove assentos
	return url_title($string,'-',TRUE);
}

// Remove acentos e caracteres especiais de uma string
function remove_acentos($string = NULL)
{
	$procurar    = array('À','Á','Ã','Â','É','Ê','Í','Ó','Õ','Ô','Ú','Ü','Ç','à','á','ã','â','é','ê','í','ó','õ','ô','ú','ü','ç');
	$substituir  = array('A','A','A','A','E','E','I','O','O','O','U','U','C','a','a','a','a','e','e','i','o','o','o','u','u','c');
	return str_replace($procurar, $substituir, $string);
}

// Gera um o resumo de um texto
function resumo_post($string = NULL, $palavras = 50, $decodifica_html = TRUE, $remove_tags = TRUE)
{
	if ($string != NULL)
	{
		if($decodifica_html)
			$string = to_html($string);
		if($remove_tags)
			$string = strip_tags($string);

		$retorno = word_limiter($string, $palavras);
	}
	else
	{
		$retorno = FALSE;
	}

	return $retorno;	
}

// Converter dados do DB para html válido
function to_html($string = NULL)
{
	return html_entity_decode($string);
}

// Retorna ou printa o conteúdo de uma view
function incluir_arquivo($view, $pasta = 'admin/includes', $echo = TRUE)
{
	$CI =& get_instance();
	if($echo)
	{
		echo $CI->load->view("$pasta/$view",'', TRUE);
		return TRUE;
	}
	return $CI->load->view("$pasta/$view", '',TRUE);
}

// Função que salva ou atualiza uma config no DB
function set_setting($nome, $valor = '')
{
	$CI =& get_instance();
	$CI->load->model('model_settings');
	if ($CI->model_settings->get_byNome($nome)->num_rows() == 1)
	{
		// Atualiza no DB
		if (trim($valor) == '')
		{
			// Excluir do DB
			$CI->model_settings->do_delete(array('config_nome'=>$nome), FALSE);
		}
		else
		{
			$dados = array(
				'config_nome' => $nome,
				'config_valor' => $valor
			);

			$CI->model_settings->do_update($dados, array('config_nome'=>$nome), FALSE);
		}	
	}
	else
	{
		// Insere no DB
		$dados = array(
			'config_nome' => $nome,
			'config_valor' => $valor
		);

		$CI->model_settings->do_insert(array('config_nome'=>$nome), FALSE);
	}
	
}

// Retorna uma Config do DB
function get_setting($nome)
{
	$CI =& get_instance();
	$CI->load->model('model_settings');

	$setting = $CI->model_settings->get_byNome($nome);

	if ($setting->num_rows() == 1)
	{
		$setting = $setting->row();
		return $setting->config_valor;
	}
	else
	{
		return NULL;
	}
}