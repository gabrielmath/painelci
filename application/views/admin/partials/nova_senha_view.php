<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
    <?php echo form_open('admin/usuarios/nova_senha', array('class' => "custom loginform")); ?>
        <fieldset>
            <legend>Recuperação de senha</legend>
            <?php
                get_msg('msgok');
                get_msg('msgerro');
                erros_validacao();
            ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label for="txtEmail">Seu E-mail:</label>
                    <input type="email" id="txtEmail" name="txtEmail" value="<?php echo (isset($email)? $email: '' ); ?>" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="admin/usuarios/login">Fazer Login</a>
                    <button type="submit" style="margin: 10px 0; float:right;" name="nova_senha" class="btn btn-primary">Enviar nova senha</button>
                </div>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
</div>