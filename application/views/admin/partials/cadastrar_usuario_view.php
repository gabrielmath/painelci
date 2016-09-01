<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
            get_msg('msgok');
            get_msg('msgerro');
            erros_validacao();
        ?>
        <?php echo form_open('admin/usuarios/cadastrar', array('class' => "custom")); ?>
            <fieldset>
                <legend>Cadastrar novo usuário</legend>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="txtNome">Nome Completo:</label>
                        <input type="text" id="txtNome" name="txtNome" value="<?php echo (isset($nome) ? $nome: '' ); ?>" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="txtEmail">Seu E-mail:</label>
                        <input type="email" id="txtEmail" name="txtEmail" value="<?php echo (isset($email) ? $email: '' ); ?>" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <label for="txtLogin">Login:</label>
                        <input type="text" id="txtLogin" name="txtLogin" value="<?php echo (isset($login) ? $login: '' ); ?>" class="form-control" required>
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
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="admin/usuarios/gerenciar" class="btn btn-danger" style="margin: 10px 0;">Cancelar</a>
                        <button type="submit" style="margin: 10px 0;" name="cadastrar" class="btn btn-success">Salvar Dados</button>
                    </div>
                </div>
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>