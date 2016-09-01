<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
            get_msg('msgok');
            get_msg('msgerro');
            erros_validacao();
        ?>
        <?php echo form_open('admin/settings/gerenciar', array('class' => "custom")); ?>
            <fieldset>
                <legend>Configuração do Sistema</legend>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="txtNome">Nome do site:</label>
                        <input type="text" id="txtNome" name="txtNome" value="<?php echo get_setting('txtNome'); ?>" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="txtUrlLogo">URL da Logomarca:</label>
                        <input type="url" id="txtUrlLogo" name="txtUrlLogo" value="<?php echo get_setting('txtUrlLogo'); ?>" class="form-control" required>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="txtEmail">E-mail do Administrador:</label>
                        <input type="email" id="txtEmail" name="txtEmail" value="<?php echo get_setting('txtEmail'); ?>" class="form-control" required>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <label for="txtLogin">Login:</label>
                        <input type="text" id="txtLogin" name="txtLogin" value="<?php //echo (isset($login) ? $login: '' ); ?>" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <label for="txtSenha">Senha:</label>
                        <div class="input-group">
                            <input type="password" id="txtSenha" name="txtSenha" class="form-control" required>
                            <div class="input-group-addon"><a id="verSenha" href="#"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <label for="txtSenha2">Confirme a senha:</label>
                        <input type="password" id="txtSenha2" name="txtSenha2" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <label class="inline-checkbox">
                            <input type="checkbox" name="ckbAdm" id="ckbAdm" value="1"> Usuário Administrador
                        </label>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!-- <a href="admin/usuarios/gerenciar" class="btn btn-danger" style="margin: 10px 0;">Cancelar</a> -->
                        <button type="submit" style="margin: 10px 0;" name="salvardados" class="btn btn-success">Salvar Configuração</button>
                    </div>
                </div>
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>