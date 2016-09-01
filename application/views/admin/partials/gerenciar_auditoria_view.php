<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php
		get_msg('msgok');
        get_msg('msgerro');
        $modo = $this->uri->segment(4);
        if($modo == 'all')
        	$limit = 0;
        else
        {
        	$limit = 50;
        	echo '<p>Mostrando os últimos 50 registros. Para ver todo o histórico, <a href="admin/auditoria/gerenciar/all">clique aqui</a></p>';
        }
	?>

		<table id="table-auditoria" class="table table-hover table-bordered" width="100%">
			<thead>
				<tr>
					<th>Usuário</th>
					<th>Data e Hora</th>
					<th>Operação</th>
					<th>Observação</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$query = $this->model_auditoria->get_all($limit)->result();
			foreach ($query as $key)
			{
				// UMA FORMA DE SE FAZER ↓
				// echo '<tr>';
				// printf('<td>%s</td>',$key->usu_nome);
				// printf('<td>%s</td>',$key->usu_login);
				// printf('<td>%s</td>',$key->usu_email);
				// printf('<td>%s / %s</td>',($key->usu_ativo == 0) ? '<span style="color: red;" class="glyphicon glyphicon-remove"></span>' : '<span style="color: green;" class="glyphicon glyphicon-ok"></span>', ($key->usu_adm == 0) ? '<span style="color: red;" class="glyphicon glyphicon-remove"></span>' : '<span style="color: green;" class="glyphicon glyphicon-ok"></span>');
				// printf('<td class="textoCentralizado">%s%s%s</td>', anchor("admin/usuarios/editar/$key->usu_id",'<span class="glyphicon glyphicon-pencil"></span>',array('class'=>'btn but btn-primary','data-toggle'=>'tooltip', 'data-placement'=>'left', 'title'=>'Editar')), anchor("admin/usuarios/alterar_senha/$key->usu_id",'<span class="glyphicon glyphicon-lock"></span>',array('class'=>'btn but btn-warning','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'Alterar Senha')), anchor("admin/usuarios/excluir/$key->usu_id",'<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn but btn-danger','data-toggle'=>'tooltip', 'data-placement'=>'right', 'title'=>'Excluir')));
				// echo '</tr>';

				// OUTRA FORMA DE SE FAZER (MINHA PREDILETA) ↓
			?>
				<tr>
					<td><?php echo $key->aud_usuario; ?></td>
					<td><?php echo date('d/m/Y H:i:s', strtotime($key->aud_data_hora)); ?></td>
					<td>
						<span data-toggle="tooltip" data-placement="bottom" title="<?php echo $key->aud_query;?>">
							<?php echo $key->aud_operacao; ?>
						</span>
					</td>
					<td><?php echo $key->aud_observacao; ?></td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
</div>