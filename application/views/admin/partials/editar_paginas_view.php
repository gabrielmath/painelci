<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $id = $this->uri->segment(4);
        if($id == NULL)
        {
            set_msg('msgerro','Escolha uma página para alterar','erro');
            redirect('admin/paginas/gerenciar');
        }
        
        get_msg('msgerro');
        $query = $this->model_paginas->get_byId($id)->row();
        erros_validacao();
        get_msg('msgok'); 
            
        incluir_arquivo('insertimg');
        ?>
        <?php echo form_open(current_url(), array('class' => "custom")); ?>
            <fieldset>
                <input type="hidden" name="txtId" value="<?php echo $id; ?>">
                <legend>Cadastrar nova página</legend>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="txtTitulo">Título:</label>
                        <input type="text" id="txtTitulo" name="txtTitulo" class="form-control" value="<?php echo $query->pag_titulo; ?>" required autofocus>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <label for="txtSlug">Slug:</label>
                        <input type="text" id="txtSlug" name="txtSlug" class="form-control" value="<?php echo $query->pag_slug; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalImg" style="margin: 10px 0;">
                            Inserir Imagens
                        </button>
                        <a href="admin/midia/cadastrar" target="_blank" class="btn btn-default btn-xs">Upload de Imagens</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="txtConteudo">Conteúdo:</label>
                        <textarea name="txtConteudo" id="txtConteudo" cols="30" rows="15" class="form-control htmleditor">
                            <?php echo to_html($query->pag_conteudo); ?>
                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="admin/paginas/gerenciar" class="btn btn-danger" style="margin: 10px 0;">Cancelar</a>
                        <button type="submit" style="margin: 10px 0;" name="editar" class="btn btn-success">Salvar dados</button>
                    </div>
                </div>
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>