<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
            get_msg('msgok');
            get_msg('msgerro');
            erros_validacao();
        ?>
        <?php echo form_open_multipart('admin/paginas/cadastrar', array('class' => "custom")); ?>
            <fieldset>
                <legend>Cadastrar nova página</legend>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="txtTitulo">Título:</label>
                        <input type="text" id="txtTitulo" name="txtTitulo" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="txtSlug">Slug:</label>
                        <input type="text" id="txtSlug" name="txtSlug" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="txtConteudo">Conteúdo:</label>
                        <textarea name="txtConteudo" id="txtConteudo" cols="30" rows="15" class="form-control htmleditor"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="admin/paginas/gerenciar" class="btn btn-danger" style="margin: 10px 0;">Cancelar</a>
                        <button type="submit" style="margin: 10px 0;" name="cadastrar" class="btn btn-success">Publica Página</button>
                    </div>
                </div>
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>