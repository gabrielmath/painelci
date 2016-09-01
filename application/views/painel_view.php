<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if(isset($titulo)): ?>{titulo}<?php endif; ?> - {titulo_padrao}</title>
	{estilos}
	<base href="<?php echo base_url(); ?>">
</head>
<body>
	<div class="container">
		<?php
			if(esta_logado(FALSE))
			{
		?>
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<a href="<?php echo base_url('admin/home'); ?>"><h1>Painel ADM</h1></a>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<p class="textoDireito">
							Logado como: <strong><?php echo $this->session->userdata('user_nome'); ?></strong>
						</p>
						<p class="textoDireito">
							<a href="admin/usuarios/alterar_senha/<?php echo $this->session->userdata('user_id');?>" class="btn btn-primary btn-xs">Alterar Senha</a>
							<a href="admin/usuarios/logoff" class="btn btn-danger btn-xs">Sair</a>
						</p>
					</div>
				</div>
				<?php $this->load->view('admin/partials/menu_admin');?>
				<?php echo breadcrumb(); ?>
		<?php } ?>
		{conteudo}
	</div>
	<footer id="footer">
		<div class="container textoCentralizado">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					{rodape}
				</div>
			</div>
		</div>
	</footer>
	<!-- SCRIP PADRÃO -->
	{scripts}
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/r/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,b-1.0.3,b-colvis-1.0.3,b-flash-1.0.3,b-html5-1.0.3,b-print-1.0.3,r-1.0.7/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.9/sorting/numeric-comma.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="<?php //echo base_url('dist/js/scriptAdm.min.js');?>" type="text/javascript" charset="utf-8" async defer></script> -->
</body>
</html>