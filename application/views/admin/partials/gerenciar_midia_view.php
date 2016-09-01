<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php
		get_msg('msgok');
        get_msg('msgerro');
	?>

		<table id="table-auditoria" class="table table-hover table-bordered" width="100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Link</th>
					<th>Miniatura</th>
					<th class="textoCentralizado">Ações</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$query = $this->model_midia->get_all()->result();
			foreach ($query as $key)
			{
			?>
				<tr>
					<td><?php echo $key->mid_nome; ?></td>
					<td>
						<input type="text" class="form-control linkImg" style="width:100%;" value="<?php echo base_url("uploads/$key->mid_arquivo");?>" readonly>
					</td>
					<td class="textoCentralizado">
						<?php echo thumb($key->mid_arquivo); ?>
					</td>
					<td class="textoCentralizado">
						<?php echo anchor("uploads/$key->mid_arquivo",'<span class="glyphicon glyphicon-search"></span>',array('class'=>'btn but btn-info','data-toggle'=>'tooltip', 'data-placement'=>'left', 'title'=>'Visualizar','target'=>'_blank')), anchor("admin/midia/editar/$key->mid_id",'<span class="glyphicon glyphicon-pencil"></span>',array('class'=>'btn but btn-primary','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>'Editar')), anchor("admin/midia/excluir/$key->mid_id",'<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn but btn-danger deletareg','data-toggle'=>'tooltip', 'data-placement'=>'right', 'title'=>'Excluir'))?>
					</td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
</div>