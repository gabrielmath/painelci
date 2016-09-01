<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <?php
    	$id = $this->uri->segment(4);
    	if($id == NULL)
    	{
    		set_msg('msgerro','Escolha um usuário para alterar','erro');
    		redirect('admin/usuarios/gerenciar');
    	}
        
        get_msg('msgerro');
        
        if (is_admin() || $id == $this->session->userdata('user_id'))
        {
        	$query = $this->model_usuarios->get_byId($id)->row();
        	erros_validacao();
    		get_msg('msgok')        
    ?>
    <?php echo form_open(current_url(), array('class' => "custom")); ?>
        <fieldset>
            <legend>Alterar Usuário</legend>
            <input type="hidden" name="txtId" value="<?php echo $id; ?>">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <label for="txtNome">Nome Completo:</label>
                    <input type="text" id="txtNome" name="txtNome" value="<?php echo $query->usu_nome; ?>" class="form-control" required autofocus>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <label for="txtEmail">Seu E-mail:</label>
                    <input type="email" id="txtEmail" name="txtEmail" value="<?php echo $query->usu_email; ?>" class="form-control" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="txtLogin">Login:</label>
                    <input type="text" id="txtLogin" name="txtLogin" value="<?php echo $query->usu_login; ?>" class="form-control" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <label class="inline-checkbox">
                        <input type="checkbox" name="ckbAtivo" id="ckbAtivo" <?php echo ($query->usu_ativo == 1) ? 'checked' : ''; ?> value="1"> Permitir o acesso deste usuários ao sistema
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="inline-checkbox">
                        <input type="checkbox" name="ckbAdm" id="ckbAdm" <?php echo ($query->usu_adm == 1) ? 'checked' : ''; ?> value="1"> Usuário Administrador
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="admin/usuarios/gerenciar" class="btn btn-danger" style="margin: 10px 0;">Cancelar</a>
                    <button type="submit" style="margin: 10px 0;" name="editar" class="btn btn-success">Editar Dados</button>
                </div>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
    <?php
    	}
        else
        {
            set_msg('msgerro','Seu usuário não tem permissão para executar esta operação','erro');
        	redirect('admin/usuarios/gerenciar');
        }
    ?>
	</div>
</div>