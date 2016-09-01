<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php
		get_msg('msgok');
        get_msg('msgerro');
	?>

		<table id="table-auditoria" class="table table-hover table-bordered" width="100%">
			<thead>
				<tr>
					<th>Título</th>
					<th>Slug</th>
					<th>Resumo</th>
					<th class="textoCentralizado">Ações</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$query = $this->model_paginas->get_all()->result();
			foreach ($query as $key)
			{
			?>
				<tr>
					<td><?php echo $key->pag_titulo; ?></td>
					<td><?php echo $key->pag_slug; ?></td>
					<td><?php echo resumo_post($key->pag_conteudo, 10); ?></td>
					<td class="textoCentralizado">
						<?php echo anchor("admin/paginas/editar/$key->pag_id",'<span class="glyphicon glyphicon-pencil"></span>',array('class'=>'btn but btn-primary','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'Editar')), anchor("admin/paginas/excluir/$key->pag_id",'<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn but btn-danger deletareg','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'Excluir'))?>
					</td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
</div>