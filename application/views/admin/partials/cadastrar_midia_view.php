<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
            get_msg('msgok');
            get_msg('msgerro');
            erros_validacao();
        ?>
        <?php echo form_open_multipart('admin/midia/cadastrar', array('class' => "custom")); ?>
            <fieldset>
                <legend>Upload de Mídia</legend>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="txtNome">Nome para exibição:</label>
                        <input type="text" id="txtNome" name="txtNome" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="txtDescricao">Descrição:</label>
                        <input type="text" id="txtDescricao" name="txtDescricao" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="arquivo">Arquivo:</label>
                        <input type="file" id="arquivo" name="arquivo" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="admin/midia/gerenciar" class="btn btn-danger" style="margin: 10px 0;">Cancelar</a>
                        <button type="submit" style="margin: 10px 0;" name="cadastrar" class="btn btn-success">Salvar Dados</button>
                    </div>
                </div>
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>