<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $id = $this->uri->segment(4);
        if($id == NULL)
        {
            set_msg('msgerro','Escolha uma mídia para alterar','erro');
            redirect('admin/midias/gerenciar');
        }
        
        get_msg('msgerro');
        $query = $this->model_midia->get_byId($id)->row();
        erros_validacao();
        get_msg('msgok');        
        ?>
        
        <?php echo form_open(current_url(), array('class' => "custom")); ?>
            <fieldset>
                <legend>Upload de Mídia</legend>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    
                    <input type="hidden" name="txtId" value="<?php echo $id; ?>">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="txtNome">Nome para exibição:</label>
                            <input type="text" id="txtNome" name="txtNome" class="form-control" value="<?php echo $query->mid_nome; ?>" required autofocus>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="txtDescricao">Descrição:</label>
                            <input type="text" id="txtDescricao" name="txtDescricao" value="<?php echo $query->mid_descricao; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <a href="admin/midia/gerenciar" class="btn btn-danger" style="margin: 10px 0;">Cancelar</a>
                            <button type="submit" style="margin: 10px 0;" name="editar" class="btn btn-success">Salvar Dados</button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 textoCentralizado">
                    <?php echo thumb($query->mid_arquivo, 300, 180); ?>
                </div>
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>