<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php
		get_msg('msgok');
        get_msg('msgerro');
	?>
		<table id="example" class="table table-hover table-bordered" width="100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Login</th>
					<th>E-mail</th>
					<th>Ativo / Adm</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$query = $this->model_usuarios->get_all()->result();
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
					<td><?php echo $key->usu_nome; ?></td>
					<td><?php echo $key->usu_login; ?></td>
					<td><?php echo $key->usu_email; ?></td>
					<td>
						<?php echo ($key->usu_ativo == 0) ? '<span style="color: red;" class="glyphicon glyphicon-remove"></span>' : '<span style="color: green;" class="glyphicon glyphicon-ok"></span>'; ?>/<?php echo ($key->usu_adm == 0) ? '<span style="color: red;" class="glyphicon glyphicon-remove"></span>' : '<span style="color: green;" class="glyphicon glyphicon-ok"></span>'; ?>
						</td>
					<td class="textoCentralizado">
						<?php echo anchor("admin/usuarios/editar/$key->usu_id",'<span class="glyphicon glyphicon-pencil"></span>',array('class'=>'btn but btn-primary','data-toggle'=>'tooltip', 'data-placement'=>'left', 'title'=>'Editar')), anchor("admin/usuarios/alterar_senha/$key->usu_id",'<span class="glyphicon glyphicon-lock"></span>',array('class'=>'btn but btn-warning','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'Alterar Senha')), anchor("admin/usuarios/excluir/$key->usu_id",'<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn but btn-danger deletareg','data-toggle'=>'tooltip', 'data-placement'=>'right', 'title'=>'Excluir'))?>
					</td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
</div>